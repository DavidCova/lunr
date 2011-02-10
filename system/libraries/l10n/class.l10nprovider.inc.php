<?php

abstract class L10nProvider
{

    /**
     * Constructor
     * @param String $language ISO-639-1 definition for the requested language (short code)
     */
    abstract public function __construct($language);

    /**
     * Destructor
     */
    abstract public function __destruct();

    /**
     * Initialization method for setting up the provider
     * @param String $language ISO-639-1 definition for the requested language (short code)
     * @return void
     */
    abstract private function init($language);

    /**
     * Return a translated string
     * @param String $identifier Identifier for the requested string
     * @return String $string Translated string, identifier by default
     */
    abstract public function lang($identifier);
}

?>