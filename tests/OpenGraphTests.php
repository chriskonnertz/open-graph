<?php

class OpenGraphTest extends PHPUnit_Framework_TestCase
{
    
    protected function getInstance()
    {
        return new ChrisKonnertz\OpenGraph\OpenGraph();
    }

    protected function getDummy()
    {
        $og = $this->getInstance();

        $og->title('Apple Cookie')
            ->type('article')
            ->image('http://example.org/apple.jpg')
            ->description('Welcome to the best apple cookie recipe never created.')
            ->url('http://example.org/')
            ->locale('de-DE');

        return $og;
    }

    public function testBasicTags()
    {
        $og = $this->getDummy();

        $this->assertTrue($og->has('title'));
        $this->assertTrue($og->has('type'));
        $this->assertTrue($og->has('image'));
        $this->assertTrue($og->has('description'));
        $this->assertTrue($og->has('url'));
        $this->assertTrue($og->has('locale'));

        $this->assertFalse($og->has('not existing tag'));
    }

    public function testMethods()
    {
        $og = $this->getDummy();

        $og->tag('fruit', 'apple');
        $this->assertTrue($og->has('fruit'));

        $og->tag('fruit', 'pear');
        $tag = $og->lastTag('fruit');
        $this->assertEquals($tag->value, 'pear');

        $og->forget('title');
        $this->assertFalse($og->has('title'));

        $og->clear();
        $this->assertFalse($og->has('type'));
    }

    public function testDateConversion()
    {
        /* Classic DateTime ---------------------------------------------------------------------------- */
        $og = $this->getDummy();

        $dateTime = new DateTime();
        $dateTime->setTimestamp(1234567890);

        $og->tag('datetime', $dateTime);

        $tag = $og->lastTag('datetime');
        $value = $tag->value;

        // ISO 8601 - summer/winter time
        $this->assertTrue($value === '2009-02-13T23:31:30+0000' || $value === '2009-02-14T00:31:30+0100');

        /* Carbon -------------------------------------------------------------------------------------- */
        $carbon = new Carbon\Carbon();
        $carbon->setTimestamp(1234567890);

        $og->tag('datetime', $carbon);

        $tag = $og->lastTag('datetime');
        $value = $tag->value;

        // ISO 8601 - summer/winter time
        $this->assertTrue($value === '2009-02-13T23:31:30+0000' || $value === '2009-02-14T00:31:30+0100');
    }

    public function testRenderTags()
    {
        $og = $this->getDummy();

        $html = $og->renderTags();

        $hmtl = 'HTML: '.$og;
    }

    public function testMbDescription()
    {
        $og = $this->getDummy();

        mb_internal_encoding('UTF-8');
        
        $char = '☺'; // Unicode char U+263A (white smiley)

        $og->description($char, 1);
        $tag = $og->lastTag('description');
        
        $this->assertEquals($tag->value, $char);
    }

    public function testUrl()
    {
        $og = $this->getDummy();

        $og->url();
        $tag = $og->lastTag('url');
        $this->assertEquals($tag->value, 'http://localhost/');

        $og->clear();

        $url = 'http://example.org/';
        putenv('APP_URL='.$url);
        $og->url($url);
        $tag = $og->lastTag('url');
        $this->assertEquals($tag->value, $url);
    }

}
