<?php


/**
 * @throws Exception
 */
function view($dir, $vars = []): void
{

    $viewBuilder = new \System\View\ViewBuilder();
    $viewBuilder->run($dir);

    // vars are data variables sent to view with composer
    $viewVars = $viewBuilder->vars;
    $content = $viewBuilder->content;

    // data variables with composer
    empty($viewVars) ?: extract($viewVars);
    // data variables with view method
    empty($vars) ?: extract($vars);

    // to run php code in html
    eval(" ?>" . html_entity_decode($content));

}

function dd($value, $die = true): void
{
    var_dump($value);
    if ($die) {
        exit();
    }
}

function html($text): string
{
    return html_entity_decode($text);
}

function old($name)
{
    if (isset($_SESSION['temporary_old'][$name])) {
        return $_SESSION['temporary_old'][$name];
    } else {
        return null;
    }
}


function flash($name, $message = null)
{

    // means show message to user
    // get message
    if (empty($message)) {

        if (isset($_SESSION['temporary_flash'][$name])) {
            $temporary = $_SESSION['temporary_flash'][$name];
            unset($_SESSION['temporary_flash'][$name]);
            // show message
            return $temporary;
        } else {
            return false;
        }
    } else {
        // set new message
        // example session name -> flash -> key : name -> value -> message
        $_SESSION['flash'][$name] = $message;
    }
}