<?php

it('has first- page', function () {
    $response = $this->get('/first-');

    $response->assertStatus(200);
});
