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
//// for flash messages
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
function flashExists($name): bool
{
    return isset($_SESSION["temporary_flash"][$name]) === true ? true : false;
}

// get all flash messages
function allFlashes()
{
    if (isset($_SESSION['temporary_flash'])) {
        $temporary = $_SESSION['temporary_flash'];
        unset($_SESSION['temporary_flash']);
        // return/show message
        return $temporary;
    } else {
        return false;
    }
}
//// for errors messages
function error($name, $message = null)
{
    // means show message to user
    // get message
    if (empty($message)) {

        if (isset($_SESSION['temporary_error'][$name])) {
            $temporary = $_SESSION['temporary_error'][$name];
            unset($_SESSION['temporary_error'][$name]);
            // show message
            return $temporary;
        } else {
            return false;
        }
    } else {
        // set new message
        // example session name -> flash -> key : name -> value -> message
        $_SESSION['error'][$name] = $message;
    }
}
function errorExists($name): bool
{
    return isset($_SESSION["temporary_error"][$name]) === true ? true : false;
}

// get all errors messages
function allErrors()
{
    if (isset($_SESSION['temporary_error'])) {
        $temporary = $_SESSION['temporary_error'];
        unset($_SESSION['temporary_error']);
        // return/show message
        return $temporary;
    } else {
        return false;
    }
}


function  currentDomain(): string
{
    $httpProtocol = ( isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on' ) ? "https://" : "http://";
    $currentUrl = $_SERVER['HTTP_HOST'];
    return $httpProtocol.$currentUrl;
}

function redirect($url) : void
{
    $url = trim($url,'/ ');
    $url = strpos($url,currentDomain()) === 0 ? $url : currentDomain().'/'.$url;
    header("Location: ".$url);
    exit(); // its important
}

function back(): void
{
    $http_refer = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : null;
    redirect($http_refer);
}

function asset($src): string
{
    return currentDomain().("/".trim($src,"/ "));
}


function url($src): string
{
    return currentDomain().("/".trim($src,"/ "));
}