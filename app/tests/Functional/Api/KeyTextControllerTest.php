<?php
declare(strict_types=1);


namespace App\Tests\Functional\Api;



use PHPUnit\Framework\TestCase;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class KeyTextControllerTest extends WebTestCase
{

    const KEY_TEXT = 'Lorem Ipsum is simply one: dummy text of the printing and  two: typesetting industry. Lorem Ipsum has been the industry\'s  one: standard dummy text ever since the three: 1500s.';

    const ARR_RESULT = [
        'one: ' => 'standard dummy text ever since the ',
        'two: ' => 'typesetting industry. Lorem Ipsum has been the industry\'s  ',
        'three: ' => '1500s.',
    ];

    public function testPostPositive(): void
    {
        $client = static::createClient();

        $client->request('POST', '/api/key-text', [], [], ['CONTENT_TYPE' => 'application/json'], sprintf('{"keyText":"%s"}', self::KEY_TEXT));

        $this->assertResponseIsSuccessful();

        $content = $client->getResponse()->getContent();

        $contentArr = json_decode($content, true);

        $this->assertEquals($contentArr['key_text'], self::ARR_RESULT);
    }

    public function testPostNegative(): void
    {
        $client = static::createClient();

        $client->request('POST', '/api/key-text', [], [], ['CONTENT_TYPE' => 'application/json'], sprintf('{"key":"%s"}', self::KEY_TEXT));

        $this->assertResponseStatusCodeSame(400);
    }

}
