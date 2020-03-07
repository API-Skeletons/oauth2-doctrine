<?php

namespace ApiSkeletonsTest\OAuth2\Doctrine;

use OAuth2\Storage\RefreshTokenInterface;

class RefreshTokenTest extends AbstractTest
{
    /** @dataProvider provideStorage */
    public function testSetRefreshToken(RefreshTokenInterface $storage)
    {
        if ($storage instanceof NullStorage) {
            $this->markTestSkipped('Skipped Storage: ' . $storage->getMessage());

            return;
        }

        // assert token we are about to add does not exist
        $token = $storage->getRefreshToken('refreshtoken');
        $this->assertFalse($token);

        // base new code on existing for user
        $testRefreshToken = $storage->getRefreshToken('testtoken');

        // add new token
        $expires = time() + 20;
        $success = $storage->setRefreshToken(
            'refreshtoken',
            'oauth_test_client',
            $testRefreshToken['user_id'],
            $expires,
            'supportedscope1 supportedscope2'
        );
        $this->assertTrue($success);

        $token = $storage->getRefreshToken('refreshtoken');
        $this->assertNotNull($token);
        $this->assertArrayHasKey('refresh_token', $token);
        $this->assertArrayHasKey('client_id', $token);
        $this->assertArrayHasKey('user_id', $token);
        $this->assertArrayHasKey('expires', $token);
        $this->assertEquals($token['refresh_token'], 'refreshtoken');
        $this->assertEquals($token['client_id'], 'oauth_test_client');
        $this->assertEquals($token['user_id'], $testRefreshToken['user_id']);
        $this->assertEquals($token['expires'], $expires);

        $this->assertTrue($storage->unsetRefreshToken('refreshtoken'));

        $this->assertTrue($storage->setRefreshToken('event_stop_propagation', '', '', '', ''));
        $this->assertTrue($storage->getRefreshToken('event_stop_propagation'));
        $this->assertTrue($storage->unsetRefreshToken('event_stop_propagation'));
    }
}
