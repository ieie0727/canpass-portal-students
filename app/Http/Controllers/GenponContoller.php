<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GenponController extends Controller
//以下だけコピー

{
  /** 初期動作 */
  public function __construct() {}


  /** 一覧表示 */
  public function index() {}


  /** 新規画面 */
  public function create() {}


  /** 新規処理 */
  public function store(Request $request) {}


  /** 詳細表示 */
  public function show($id) {}


  /** 編集画面 */
  public function edit($id) {}


  /** 編集処理 */
  public function update(Request $request, $id) {}

  /** 削除処理 */
  public function destroy($id) {}
}
