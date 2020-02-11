# chance

chance js library clone for php

```
    $chance = new Chance($seed);
    $chance->natural(['min' => 1, 'max' => 100]);
    $chance->integer(['min' => -10, 'max' => 10]);
    $chance->floating(['min' => -10, 'max' => 10, 'fixed' => 3]);
    $chance->prime();

    $chance->age();
    $chance->gender();
    $chance->email();


    $chance->coin();
    $chance->string();
    $chance->bool();
    $chance->boolean();
    $chance->letter();
    $chance->word();

    $chance->domain();
    $chance->ip();
```
