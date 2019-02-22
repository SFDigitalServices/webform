<?php

class RoutesCest
{

    public function openPageByRoute(FunctionalTester $I)
    {
        $I->amOnRoute('getForms');
        $I->seeCurrentUrlEquals('/form/getForms');
    }

    public function openPageByRouteWithMultipleParameters(FunctionalTester $I)
    {
        //$I->amOnRoute('complex-route', ['a', 'b']);
        //$I->seeCurrentUrlEquals('/complex-route/a/b');
    }

}