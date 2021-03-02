<?php

if (mail('manuel.pe97a.aema@gmail.com', 'Prova php', 'Això és una prova de mail en php')) {
    echo "Email sent";
} else {
    echo 'Email not sent';
}
