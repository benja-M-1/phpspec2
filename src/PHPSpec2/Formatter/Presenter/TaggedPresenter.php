<?php

namespace PHPSpec2\Formatter\Presenter;

class TaggedPresenter extends StringPresenter
{
    public function presentString($string)
    {
        return '<value>'.parent::presentString($string).'</value>';
    }

    protected function presentCodeLine($number, $line)
    {
        return sprintf('<lineno>%s</lineno> <code>%s</code>', $number, $line);
    }

    protected function presentHighlight($line)
    {
        return '<hl>'.$line.'</hl>';
    }

    protected function presentExceptionTraceHeader($header)
    {
        return sprintf("<trace>%s</trace>\n", $header);
    }

    protected function presentExceptionTraceMethod($class, $type, $method, array $args)
    {
        $args = array_map(array($this, 'presentValue'), $args);

        return sprintf(
            "   <trace><trace-class>%s</trace-class><trace-type>%s</trace-type>".
            "<trace-func>%s</trace-func>(<trace-args>%s</trace-args>)</trace>\n",
            $class, $type, $method, implode(', ', $args)
        );
    }

    protected function presentExceptionTraceFunction($function, array $args)
    {
        $args = array_map(array($this, 'presentValue'), $args);

        return sprintf(
            "   <trace><trace-func>%s</trace-func>(<trace-args>%s</trace-args>)</trace>\n",
            $function, implode(', ', $args)
        );
    }
}
