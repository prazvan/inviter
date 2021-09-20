<?php

namespace App\Helpers\Traits;

/**
 * The Singleton trait helps us to implement the "Singleton" pattern on any given class
 */
trait Singleton
{
    /**
     * Self Instance
     *
     * @var self
     */
    private static $instance = null;

    /**
     *  Make Singleton Instance of given class
     * @return static
     */
    public static function make(): self
    {
        // make new instance
        return (!self::$instance) ? self::$instance = new self() : self::$instance;
    }

    /**
     * Don't allow new instances
     */
    private function __construct()
    {
        // you wish..
    }

    /**
     *  Prevent cloning of the given instance
     */
    protected function __clone() {
        // no object cloning for you
    }

    /**
     * Prevent serialization of the instance
     */
    protected function __sleep() {
        // you had way to many red bulls, no sleep for ya :)
    }

    /**
     * Prevent deserialization of the instance
     */
    protected function __wakeup() {
        // you can't wake up if you're not sleeping :)
    }
}
