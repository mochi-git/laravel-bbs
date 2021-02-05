<DOCTYPE HTML>
    <html lang="ja">

    <head>
        <meta charset="UTF-8">
        <title>@yield('title')｜magicmissile.info</title>
        <meta name="description" itemprop="description" content="@yield('description')">
        <meta name="keywords" itemprop="keywords" content="@yield('keywords')">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- <script src="{{ asset('js/app.js') }}" defer></script> -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>

        <!-- Custom styles for this template -->
        <link href="/css/bbs/sticky-footer.css" rel="stylesheet">
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">

        @yield('pageCss')
    </head>

    <body>

        @yield('header')

        <div class="container">
            @yield('content')
        </div>
        <!--//container-->

        @yield('footer')
        <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
        <!-- <script src="{{ mix('js/app.js') }}"></script> -->
    </body>

    </html>
    <script>
        const app = new Vue({
            el: '#app',

            /*掲示板
            data() {
                return {
                    text: "データ取得",
                    items: [],
                    users: [],
                }
            },
            created() {
                axios.get('/user')
                    .then(response => {
                        this.users = response.data.users;
                    })
                    .catch(error => {
                        console.log(error)
                    });
            },
            // mounted() {
            //     axios.get('/posts').then(response => this.items = response.data)
            // },
            methods: {
                request: function() { //←axios.getでデータを取得
                    this.text = "読込中"
                    axios.get('/posts').then((response) => {
                            console.log(response.data);
                            this.items = response.data; //取得したデータをitemsに格納
                            this.text = "読込完了"
                        })
                        .catch(error => console.log(error))
                },

                deleteRow: function(id, index) {
                    console.log(id)
                    this.items.splice(index, 1)
                }
            },          

            // created() {  //最初にメソッドを実行
            //     this.request()
            // },
            */

            /*ページネーション
            data() {
                const items = new Array(200).fill(null).map((e, i) => `Item ${i + 1}`);
                const perPage = 10;

                return {
                    items, //表示するデータがここに入る
                    page: 1, //現在のページ番号
                    perPage, //1ページ毎の表示件数
                    totalPage: Math.ceil(items.length / perPage), //総ページ数
                    count: items.length, //itemsの総数
                    currentPage: this.page
                };
            },
            computed: {
                filterItems() {
                    // axios.get('/users').then((response) => {
                    //         console.log(response.data);
                    //         this.items = response.data; //取得したデータをitemsに格納
                    //     })
                    //     .catch(error => console.log(error))

                    // return this.items.slice((this.page - 1) * this.perPage, this.page * this.perPage);
                    return this.items.filter(
                        (item, i) =>
                        i >= (this.page - 1) * this.perPage && i < this.page * this.perPage
                    );
                },

                prevPage() {
                    return Math.max(this.currentPage - 1, 1);
                },
                nextPage() {
                    return Math.min(this.currentPage + 1, this.totalPage);
                }
            },
            methods: {
                onPageChange(page) {
                    this.page = page;
                    // window.history.replaceState({
                    //         page
                    //     },
                    //     `Page${page}`,
                    //     `${window.location.origin}/?page=${page}`
                    // );
                },
                onPrev() {
                    this.currentPage = this.prevPage;
                    this.$emit("change", this.currentPage);
                },
                onNext() {
                    this.currentPage = this.nextPage;
                    this.$emit("change", this.currentPage);
                }
            }
            */




            data() {
                return {
                    users: []
                }
            },
            created() {
                axios.get('/user')
                    .then(response => {
                        this.users = response.data.users;
                    })
                    .catch(error => {
                        console.log(error)
                    });
            }

        });
    </script>

    <!-- <style>
        .pagination {
            text-align: center;
        }

        .pagination * {
            display: inline;
        }

        a {
            border: 0;
            background: none;
            font-size: initial;
            margin: 0 1rem;
        }
    </style> -->