@extends('layouts.public')

@section('header_style')
    @php
        $menu = \App\Models\frontend_menu::selectRaw('tbl_frontend_menu.id, tbl_frontend_menu.menu_type, tbl_frontend_menu.caption, tbl_frontend_menu.target_url, tbl_frontend_menu.target_slug, count(b.id) as jml_sub')
            -> leftJoin('tbl_frontend_menu as b', 'b.refid', '=', 'tbl_frontend_menu.id')
            -> whereRaw('tbl_frontend_menu.status="0" And tbl_frontend_menu.refid=0 And tbl_frontend_menu.published_by > 0 And Not IsNull(tbl_frontend_menu.published_at)')
            -> groupByRaw('tbl_frontend_menu.id')
            -> orderBy('tbl_frontend_menu.sequence')
            -> get();
    @endphp
@endsection

@section('body')
    @include($pages)
@endsection