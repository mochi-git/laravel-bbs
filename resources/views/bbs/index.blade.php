@extends('layout.bbslayout')

@section('title', 'LaravelPjt BBS 投稿の一覧ページ')
@section('keywords', 'キーワード1,キーワード2,キーワード3')
@section('description', '投稿一覧ページの説明文')
@section('pageCss')
<!-- <link href="/css/bbs/style.css" rel="stylesheet"> -->
@endsection

@include('layout.bbsheader')

@section('content')

<!-- <div id="app">
    <button @click="request">データ取得</button>
    <ul >
        <li v-for="item in items">@{{ item.name }}</li>
    </ul> -->
<!-- <div v-for="m in messages">
        <span v-text="m.created_at"></span>：&nbsp;
        <span v-text="m.subject"></span>
    </div> -->
<!-- <ul>
        <li v-for="user in users">@{{ user.name }}</li>
    </ul> -->
<!-- </div> -->


<div class="mt-4 mb-4">
    @if (Auth::check())
    <p>USER: {{$user->name . ' (' . $user->email . ')'}}（<a href="/home">マイページ</a>）</p>
    @else
    <p>※ログインしていません。（<a href="/login">ログイン</a>｜
        <a href="/register">登録</a>）
    </p>
    @endif
</div>

<div class="mt-4 mb-4">
    <a href="{{ route('bbs.create') }}" class="btn btn-primary">
        投稿の新規作成
    </a>
</div>
@if (session('poststatus'))
<div class="alert alert-success mt-4 mb-4">
    {{ session('poststatus') }}
</div>
@endif

<!-- 検索フォーム -->
<div class="mt-4 mb-4">
    <form class="form-inline" method="GET" action="{{ route('bbs.index') }}">
        <div class="form-group">
            <input type="text" name="searchword" value="{{$searchword}}" class="form-control" placeholder="名前を入力してください">
        </div>
        <input type="submit" value="検索" class="btn btn-info ml-2">
    </form>
</div>

<div class="mt-4 mb-4">
    <p>{{ $posts->total() }}件が見つかりました。</p>
</div>

<div class="mt-4 mb-4">
    @foreach($categories as $id => $name)
    <span class="btn"><a href="{{ route('bbs.index', ['category_id'=>$id]) }}" title="{{ $name }}">{{ $name }}</a></span>
    @endforeach
</div>

<div id="app">

    <!-- <div id="nav">
        <router-link to="/">Home</router-link>
    </div>
    <router-view /> -->

    <!-- ページネーション<div class="content">
        <ol>
            <li v-for="(item, i) in filterItems" :key="i">@{{item}}</li>
        </ol>

        <div class="pagination">
            <a :href="`?page=${prevPage}`" class="prev" v-if="currentPage > 1" @click.prevent="onPrev" @change="onPageChange">&lt; 前へ</a>
            <div class="total">ページ @{{currentPage}}/@{{totalPage}}</div>
            <a :href="`?page=${nextPage}`" class="next" v-if="currentPage < totalPage" @click.prevent="onNext" @change="onPageChange">次へ &gt;</a>
        </div>
    </div> -->

    <!-- <div id="nav">
        <router-link to="/bbs">Home</router-link>
    </div>
    <router-view /> -->


    <h1>ユーザ一覧</h1>
    <ul>
        <li v-for="user in users" v-text="user.name" v-bind:key="user.id"></li>
    </ul>
    <!-- <ul>
        <li v-for="user in users" v-bind:key="user.id">
            @{{ user.name}}
            <router-link :to="`/user/${user.id}`">詳細</router-link>
        </li>
    </ul> -->

    <!-- vue掲示板<button @click="request">@{{ text }}</button>
    <div class="table-responsive-md">
        <table class="table table-hover table-dark">
            <tbody id="tbl">
                <tr v-for="item in items">
                    <td>[@{{ item.id }}] @{{ item.created_at }} 名前：@{{ item.name }} @{{ item.count }}
                        <p>[カテ@{{ item.category_id }}] 件名：@{{ item.subject }}</p>
                        <p>@{{ item.message }}</p>
                        <button class="btn btn-danger" v-on:click="deleteRow(item.id, index)">削除</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div> -->

</div>

<div class="table-responsive-md">
    <table class="table table-hover table-dark">
        <!-- <thead>
        <tr>
            <th><a href="/bbs?sort=id">ID</a></th>
            <th><a href="/bbs?sort=category_id">カテゴリ</a></th>
            <th><a href="/bbs?sort=created_at">作成日時</a></th> -->
        <!-- <th>名前</th>
            <th>件名</th>
            <th>メッセージ</th>
            <th>処理</th> -->
        <!-- </tr>
        </thead> -->
        <tbody id="tbl">
            @foreach ($posts as $post)
            <tr>
                <td>[{{ $post->id }}] {{ $post->created_at->format('Y.m.d') }} 名前：{{ $post->name }}</td>
            </tr>
            <tr>
                <td>[{{ optional($post->category)->name }}] 件名：{{ $post->subject }}</td>
            </tr>
            <tr>
                <td>{!! nl2br(e(Str::limit($post->message, 100))) !!}
                    @if ($post->comments->count() >= 1)
                    <p><span class="badge badge-primary">コメント：{{ $post->comments->count() }}件</span></p>
                    @else
                    <p>&nbsp;</p>
                    @endif

                    <div style="display:inline-flex">
                        <p><a href="{{ action('PostsController@show', $post->id) }}" class="btn btn-primary btn-sm">詳細</a>
                            <a href="{{ action('PostsController@edit', $post->id) }}" class="btn btn-info btn-sm">編集</a>

                        <form method="POST" action="{{ action('PostsController@destroy', $post->id) }}">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm">削除</button>
                        </form>
                        </p>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
<div class="d-flex justify-content-center mb-5">
    {{ $posts->appends([
    'category_id' => $category_id,
    'sort' => $sort,
    'searchword' => $searchword
    ])->links() }}
</div>
@endsection

@include('layout.bbsfooter')