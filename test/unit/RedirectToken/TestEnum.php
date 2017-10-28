<?php

namespace Test\RedirectToken;

class TestEnum
{
    const VALID_SECRET_KEY = 'abcdefghij';
    const SHORT_SECRET_KEY = 'a';

    const MATCHING_URL = 'https://www.google.co.uk/';
    const MATCHING_URL_TOKEN = '86d4609fa2460a420ae5ea4a31db8f606dda48805ebe767fc42dec2adc1b9bfa';

    const UNMATCHING_URL = 'https://www.invalid.com/';
    const UNMATCHING_URL_TOKEN = 'asdasdasfasfd';
}