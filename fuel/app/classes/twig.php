<?php

class View_Twig extends \Parser\View_Twig
{
    public static function parser()
    {
        $parser = parent::parser();
        
        $parser->addFunction("lang", new Twig_Function_Function("Lang::line"));
        $parser->addFunction("uri", new Twig_Function_Function("Uri::create"));
        $parser->addFunction("img", new Twig_Function_Function("Asset::img"));
        $parser->addFunction("js", new Twig_Function_Function("Asset::js"));
        $parser->addFunction("current_uri", new Twig_Function_Function("Uri::current"));
        $parser->addFunction("css", new Twig_Function_Function("Asset::css"));
        $parser->addFunction("config", new Twig_Function_Function("Config::get"));
        
        return $parser;
    }
}
