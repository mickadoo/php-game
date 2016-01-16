<?php

$results = [];

function formatAnswers (&$answer, $key) {
    $answer = $key + 1 . ') ' .  $answer . PHP_EOL;
};

function doChoice($situation) {

    $question = key($situation);
    $situationChoices = $situation[$question];
    $potentialAnswers = array_keys($situationChoices);
    $validInputs = range(1, count($potentialAnswers));

    array_walk($potentialAnswers, 'formatAnswers');

    do {
        echo $question . PHP_EOL . implode($potentialAnswers) . '=> ';
        $answer = rtrim( fgets( STDIN ), "\n" );
    } while ( !in_array($answer, $validInputs));

    $result = array_values($situationChoices)[$answer - 1];

    if (!is_array($result)) {
        echo $result . PHP_EOL;
    } else {
        doChoice($result);
    }
}

$stories = [
    'what direction will you go?' => [
        'north' => [
            'you continue for miles without seeing anything. what will you do?' => [
                'leave road' => 'a giant monster appeared and broke your neck',
                'continue' => [
                    'a castle appears in front of you. what will you do?' => [
                        'enter' => 'the castle is owned by a mad king. he makes you his slave and you work there for the rest of your short life',
                        'climb' => [
                            'you scale the castle walls. eventually you come to a window where you see a king sleeping. what will you do?' => [
                                'enter' => [
                                    'the king hasn\'t woken up. what will you do to him?' => [
                                        'wake' => 'the king wakes up and roars angrily. the guards come and beat you to death with guitars',
                                        'kill' => 'as you drive your sword into the kings side his mouth opens and an evil spirit streams out. you\'ve killed the wicked king of Norrland and you are declared a hero'
                                    ]
                                ],
                                'more climbing' => 'your arms get tired and eventually you fall to your death'
                            ]
                        ],
                    ]
                ],
            ]
        ],
        'south' => [
            'you see a bridge, will you cross it?' => [
                'yes' => 'the bridge broke and you fell to your death',
                'no' => 'you stayed in the same place for the rest of your short life',
            ]
        ],
        'east' => [
            'you meet an old woman on the road, say hello?' => [
                'yes' => [
                    'she greets you friendlily and offers you directions. follow her directions?' => [
                        'yes' => 'your faith in people paid off, with her help you reached your goal.',
                        'no' => 'you get lost in a dark forrest and eventually a wolf eats you for dinner'
                    ]
                ],
                'no' => 'the woman scowls at you. after you pass her she turns around and shoots you in the back'
            ],
        ],
        'west' => [
            'you see a cat. be nice to the cat?' => [
                'yes' => 'after stroking the cat\'s back it turns into a witch and grants you superpowers. You win!',
                'no' => 'lasers shoot from the cat\'s eyes, destroying you instantly',
            ]
        ],
    ]
];

doChoice($stories);
