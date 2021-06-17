<?php

namespace App\Tests\Controller\Admin;

use App\Tests\BaseWebTestCase;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;

class SecurityControllerTest extends BaseWebTestCase
{
    /**
     * @var KernelBrowser
     */
    protected $client;

    protected function setUp()
    {
        $this->client = static::makeClient([false]);
    }

    public function testAdminLoginUrlWorks()
    {
        $this->client->request('GET', '/login');

        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
    }

    public function testAdminLogoutUrlRedirectsToLoginWindow()
    {
        $this->client->request('GET', '/logout');

        $this->assertRedirectTo($this->client, 'http://localhost/login');
    }
}
