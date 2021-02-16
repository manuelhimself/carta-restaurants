var reserves;
var grafic;
var taula;
var id = sessionStorage.getItem('key');

if (id == null) {
    window.location.replace("iniciSesio.html");
}

function loadData() {
    var d = $("#data").val();
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            reserves = JSON.parse(this.responseText);
            taula = $("#reserva").DataTable({
                data: reserves,
                dom: "Bfrtip",
                resposive: true,
                buttons: ["copy", "excel", "pdf"],
                columns: [{
                        data: "nomUsuari",
                    },
                    {
                        data: "hora",
                    },
                    {
                        data: "comensals",
                    },
                ],
                responsive: true,
                order: [
                    [1, "asc"]
                ],
                language: {
                    url: "//cdn.datatables.net/plug-ins/1.10.19/i18n/Catalan.json",
                },
                select: true,
                destroy: true,
            });
        }
    };
    xhttp.open("POST", api + "/reserves/reserves.php?data=" + d + "&id=" + id, false);
    xhttp.send();
}

var margin = {
        top: 30,
        right: 30,
        bottom: 70,
        left: 60,
    },
    width = 460 - margin.left - margin.right,
    height = 460 - margin.top - margin.bottom;

var svg = d3
    .select("#svg")
    .append("svg")
    .attr("width", width + margin.left + margin.right)
    .attr("height", height + margin.top + margin.bottom)
    .append("g")
    .attr("transform", "translate(" + margin.left + "," + margin.top + ")");

d3.json("/api/controller/reserves/graficReserves.php?id=" + id, function(data) {
    data.sort(function(b, a) {
        return a.Value - b.Value;
    });

    var x = d3
        .scaleBand()
        .range([0, width])
        .domain(
            data.map(function(d) {
                return d.mes;
            })
        )
        .padding(0.2);
    svg
        .append("g")
        .attr("transform", "translate(0," + height + ")")
        .call(d3.axisBottom(x))
        .selectAll("text")
        .attr("transform", "translate(-10,0)rotate(-45)")
        .style("text-anchor", "end");

    var y = d3.scaleLinear().domain([0, 100]).range([height, 0]);
    svg.append("g").call(d3.axisLeft(y));

    svg
        .selectAll("mybar")
        .data(data)
        .enter()
        .append("rect")
        .attr("x", function(d) {
            return x(d.mes);
        })
        .attr("y", function(d) {
            return y(d.suma);
        })
        .attr("width", x.bandwidth())
        .attr("height", function(d) {
            return height - y(d.suma);
        })
        .attr("fill", "#A33E3E");
});