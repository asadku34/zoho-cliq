<?php

/*
 * You can place your custom package configuration in here.
 */
return [

    /*
    |-------------------------------------------------------------
    | AuthToken
    |-------------------------------------------------------------
    |
    | This package will work only for authtoken.
    | Copy paste the following URL in your browser, once you're logged into your Zoho Account.
    | https://accounts.zoho.com/apiauthtoken/create?SCOPE=ZohoCliq/InternalAPI
    | You will get the authtoken then.
    |
    */
    'authtoken' => env('CLIQ_AUTHTOKEN', ''),

    /*
    |-------------------------------------------------------------
    | Default channel
    |-------------------------------------------------------------
    |
    | The default channel we should post to. The channel can either be a
    | channel like #default, a private #group, or a @username.
    |
    */
    'channel' => env('DEFAULT_CLIQ_CHANNEL', ''),

    /*
    |-------------------------------------------------------------
    | Default Send To
    |-------------------------------------------------------------
    |
    | The default message sending options is channel. You can change this default
    | from the following: channelsbyname, bots, chats, buddies
    |
    */

    'send_to' => env('DEFAULT_SEND_TO', 'channelsbyname'),
];
