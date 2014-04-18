<?php

use Mockery as m;

class TableLineTest extends PHPUnit_Framework_TestCase
{
    protected $line;

    public function setUp()
    {
        $this->line = m::mock('ChrisKonnertz\OpenGraph\OpenGraph')->makePartial();
    }

    public function tearDown()
    {
        m::close();
    }

    public function testBasicTags()
    {
        $og = new OpenGraph();

        $og->title('Apple Cookie')
            ->type('article')
            ->image('http://example.org/apple.jpg')
            ->description('Welcome to the best apple cookie recipe never created.')
            ->url();
    }

}