<?

function bloquea($recurso)
{
while (!@mkdir($recurso,0700));
}

function desbloquea($recurso)
{
rmdir($recurso);
}
?>