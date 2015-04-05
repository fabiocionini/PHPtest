<?php
/**
 * Created by PhpStorm.
 * User: fabio
 * Date: 05/04/15
 * Time: 17:33
 */

namespace Example\Core;


abstract class BaseController {

    /**
     * Show the form for creating a new resource.
     *
     * @param array $params
     * @return Object
     */
    public function create($params)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Object
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @param array $params
     * @return Response
     */
    public function update($id, $params)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }

}