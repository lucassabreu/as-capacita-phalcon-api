<?php
return call_user_func(
    function () {
        $MovimentCollection = new \Phalcon\Mvc\Micro\Collection();

        $MovimentCollection
            ->setPrefix('/v1/users/{iUserId:\d+}/moviments')
            ->setHandler('\App\Users\Controllers\MovimentsController')
            ->setLazy(true);

        $MovimentCollection->get('/', 'getMoviments');
        $MovimentCollection->get('/between/{dtMovStart:\d+}/{dtMovEnd:\d+}', 'getMovimentsBetween');
        $MovimentCollection->get('/{id:\d+}', 'getMoviment');

        $MovimentCollection->post('/', 'addMoviment');

        $MovimentCollection->put('/{id:\d+}', 'editMoviment');

        $MovimentCollection->delete('/{id:\d+}', 'deleteMoviment');

        return $MovimentCollection;
    }
);
