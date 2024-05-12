<?php
function getCustomLink($index) {
    switch ($index) {
        // Soccer
        case 11772172:
            return 5;

        // NFL
        case 11275304:
            return 17;
        case 11275346:
            return 16;
        case 11275325:
            return 22;
        case 11275323:
            return 18;
        case 11275322:
            return 20;
        case 11275321:
            return 19;
        case 11275318:
            return 21;
        case 11275306:
            return 23;
        case 11275324:
            return 25;
        case 11274062:
            return 24;
        case 11275330:
            return 26;

        // NBA
        case 11550576:
            return 14;

        // NHL
        case 11386052:
            return 20;


        default:
            return null;

    }
}