<?php

namespace Tests\Browser;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class LoginTest extends DuskTestCase
{
    use DatabaseMigrations;

    /**
     * A Dusk test login.
     *
     * @return void
     */
    public function testLogin()
    {
        $user = User::factory()->create([
            'email' => 'test@mail.com',
        ]);

        $this->browse(function (Browser $browser) use ($user) {
            $browser->visit('/login');
            $browser->type('email', $user->email);
            $browser->type('password', 'password');
            $browser->click('.login_btn');
            $browser->assertPathIs('/');
        });
    }
}
