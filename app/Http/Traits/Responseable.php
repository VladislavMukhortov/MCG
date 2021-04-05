<?php

namespace App\Http\Traits;

use Illuminate\Http\RedirectResponse;

trait Responseable
{
    /**
     * @return RedirectResponse
     */
    protected function backSuccess()
    {
        return back()->with('success', 200);
    }

    /**
     * @param $route
     * @param array $params
     * @return RedirectResponse
     */
    protected function redirectSuccess($route, $params = [])
    {
        return redirect()->route($route, $params)->with('success', 200);
    }

    /**
     * @param null $data
     * @return array
     */
    protected function success($data = null)
    {
        return ['status' => 200, 'success' => true, 'data' => $data];
    }

    /**
     * @param \Throwable $exception
     * @param array $data
     * @return array
     */
    protected function fail(\Throwable $exception, $data = [])
    {
        report($exception);
        return ['status' => $exception->getCode(), 'success' => false, 'data' => $data];
    }
}
