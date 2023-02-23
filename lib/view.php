<?php

function html_escape(string $string, string $encoding = 'UTF-8') : string
{
    if ($string === '') {
        return '';
    }

    return htmlspecialchars($string, ENT_QUOTES, $encoding);
}


function e(string $string) : string
{
    return html_escape($string);
}


/*
    function error_for(string $field, array $errors, string $format) : string

    Die Funktion erhält den Namen eines Formularfeldes
    und ein assoziatives Array mit Fehlermeldungen, deren
    Keys gleich den Namen der Formularfelder sein müssen.

    Die Funktion findet die Fehlermeldung für das entsprechende
    Feld und fomatiert sie gemäß einem printf-Format-String.

    sprintf ist eine vielseitige String-Formatierfunktion.

    In einem solchen Format String kann mit %s ein Platzhalter
    für einen String eingefügt werden. Dieser String ist unsere
    Fehlermeldung. Das könnte zB so aussehen:

    $format = "<div class=\"alert\">%s</div>"

    Die Fehlermeldung wird dann an die Stelle von %s ausgegeben.
    Der Funktionsaufruf wäre dann:

    sprintf($format, $errors[$field]);

*/

function error_for(
    string $field,
    array $errors,
    string $format = '<div class="alert">%s</div>'
) : string
{
    if (isset($errors[$field])) {
        return sprintf($format, $errors[$field]);
    }

    return '';
}
