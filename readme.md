### 具体流程
1.
创建模型和数据库：<br>
`php artisan make:model Book -m`<br>
创建控制器：<br>
`php artisan make:controller BookController`<br>
创建路由<br>
创建验证器：`php artisan  make:request BookValidateRequest`<br>
2.
打开模型`model`插入操作字段
3.
打开数据库插入字段在迁移数据库
`php artisan migrate`
### 分页
1.
运行**composer**`php artisan vendor:publish`选择`laravel-pagination`
2.
引入路径
`{{ $books->links('vendor.pagination.semantic-ui') }}`
### 获取该文章下有多少文摘
1.
查看模型`Book.php`是否有关联
```php
 public function article()
    {
        return $this->hasMany(Article::class);
    }
```
2.
在`BookController`控制器`index`方法下使用`withCount`
```php
$books = Book::orderBy('created_at','desc')->withCount('article')->paginate(10);
dd($books->toArray());
```
3.
视图使用`{{ $book->article_count }}` 篇文摘

### 只有主页的menu才能固定

`{{ Request::path() == '/' ? 'fixed' : '' }}`

### Active

1.传统`Request`判断

```html
<a class="item {{ Request::path() == '/' ? 'active' : '' }}" href="/">主页</a>
<a class="item {{ Request::path() == 'book' ? 'active' : ''}}" href="{{ url('book') }}">书架</a>
<a class="item {{ Request::path() == 'article' ? 'active' : ''}}" href="{{ url('article') }}">文摘</a>
```
2.`composer`安装`active`包

<a href="https://github.com/letrunghieu/active">Github`active`地址</a>

```html
 <a class="item {{ active_class(if_uri('book')) }}" href="{{ url('book') }}">书架</a>
```

### 权限
#### 方法一
1.普通用户
> 只能访问文摘首页和详细页

```php
public function __construct()
{
    //except 可以访问的页面
    $this->middleware('auth')->except(['index','show']);
}
```    

2.普通管理员

- **创建middleware**

`php artisan make:middleware isAdmin`
- **目录Middleware/isAdmin.php**
```php
public function handle($request, Closure $next)
{
    //use Illuminate\Support\Facades\Auth;
    if(Auth::user()->is_admin()){
        //跳转下一个请求            
        return $next($request);
    }else{
        return redirect('/');
    }
    
}
```
- **目录Kernel/$routeMiddleware**
```php
//use App\Http\Middleware\isAdmin;
'isadmin' => isAdmin::class
```

- **路由**

```php
//里面添加不想让用户访问的地址
Route::group(['middleware' => ['auth' , 'isadmin']] , function(){
    Route::any('admin/setAdmin/{id}/{is_admin}','AdminController@setAdmin');
    Route::any('admin/setDisable/{id}/{is_disable}','AdminController@setDisable');
    Route::get('admin/article','AdminController@article');
    Route::get('admin/book','AdminController@book');
    Route::get('admin','AdminController@index');
    Route::get('admin/tag','AdminController@tag');
});
```

#### 方法二

- **创建策略文件**

`php artisan make:policy ArticlePolicy --model=Article`

- **ArticlePolicy.php**

```php
class ArticlePolicy
{
    use HandlesAuthorization;
    /**
     * 前置操作
     * 判断是管理员
     */
    public function before($user)
    {
        return $user->is_admin();
    }
    public function view(User $user, Article $article)
    {
        return $user->is_disable() != 1;
    }
    /**
     * 能否查看这个视图
     */
    public function create(User $user)
    {
        
    }
    public function update(User $user, Article $article)
    {
        return $user->id === $article->user_id;
    }

    public function delete(User $user, Article $article)
    {
        return $user->id === $article->user_id;
    }
}
```
- **添加参数Providers/$policies**

```php
protected $policies = [
    'App\Model' => 'App\Policies\ModelPolicy',
    'App\Article' => 'App\Policies\ArticlePolicy'
];
```

- **模板展示**

    * 在实例化的`User`模型中直接使用`can()`或`cant()`判断权限
    * 在`Controller`中使用`authorize`方法确定是否拥有权限
    * 在`Blabe`模板中使用`@can  @endcan`来判断权限 == **[用的是它]**

```html
{{- aritcle/index -}}
@can('update',$article)
<a class="ui right floated blue button" href="{{ url('article/edit', ['aid'=> $article->id]) }}">
    修改
</a>
@endcan
@can('delete',$article)
<a class="ui right floated red button" href="{{ url('article/del', ['aid'=> $article->id]) }}" >
    删除
</a>
@endcan
```
### 优化

#### 使用Cache并打开redis

1.Cache
```php
public static function getHotBooks()
{
//        if(Cache::has('hot_books')){
//            return Cache::get('hot_books');
//        }
//        *******************
//        Cache::put('hot_books',$book,3);
    $book = Cache::remember('hot_books',5,function(){
        $book_ids = Article::select(DB::raw('count(*) as article_count, book_id'))
            ->whereNotNull('book_id')
            ->groupBy('book_id')
            ->orderBy('article_count','DESC')
            ->limit(4)
            ->get()
            ->pluck('book_id');//pluck 以其中值整合

        $book = self::whereIn('id',$book_ids)
            ->select(['title','desc','cover','content']) //尽量做到需要什么字段缓存什么字段，不用缓存整个模块
            ->withCount('article')
            ->get();
        return $book;
    });
    return $book;
}
```
> 使用cache可以不用打开redis,因为CACHE_DRIVER默认file

2.redis

把`CACHE_DRIVER=file`改为`redis`

```php
127.0.0.1:6379> keys *
1) "laravel_cache:hot_books"
127.0.0.1:6379> get laravel_cache:hot_books
```

> 清除缓存 php artisan cache:clear

### 人性化时间显示

**model操作**
```php
//人性化时间显示  get【UserName】Attribute
use Carbon\Carbon;
public function getCreatedAtAttribute($date)
{
    return Carbon::parse($date)->diffForHumans();
}
```
> 这里显示的是`英文`,需要在`Providers/AppServiceProvider.php/boot`方法里增加`中文`

```php
use Carbon\Carbon;
public function boot()
{
    Carbon::setLocale('zh');
}
```

### 消息通知

#### 用户提交评论
1.**创建Notifications**

`php artisan make:notification ReplyComment`

```php
class ReplyComment extends Notification
{
    use Queueable;
    protected $data;//添加的

    public function __construct(Array $data)
    {
        //添加的
        $this->data = $data;
    }

    public function via($notifiable)
    {
        //添加的
        //['mail']指向toMail
        //['database']指向toArray
        return ['database'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
    }

    public function toArray($notifiable)
    {
        //添加的
        return $this->data;
    }
}

```
2.**添加迁移文件**

`php artisan notifications:table`

![](https://upload-images.jianshu.io/upload_images/12353119-ae56df8563866918.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

```php
public function down()
{
    Schema::dropIfExists('notifications');
}
```

3.**接收消息的载体`User.php`**

**User.php**
```php
use Illuminate\Notifications\Notifiable;
use Notifiable; //系统自动加的,接收消息的模型
public function article()
{
    return $this->hasMany(Article::class);
}
```

4.**在`CommentController.php`建立提交消息关联**

```php
public function store(Request $request)
{
    $data = $request->all();
    $user = Auth::user();
    $data['user_id']= $user->id;
    $article =Article::find($request->article_id);
    $article->comment()->create($data);

    //发送消息
    $article->user->notify(new ReplyComment([
        'user_name' => $user->name,
        'title' => $article->title,
        'content' => $data['content']
    ]));
    return back()->with('success','发送评论成功');
}
```
#### 展示未读消息

![](https://upload-images.jianshu.io/upload_images/12353119-4b6f37446ad920c5.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)
![](https://upload-images.jianshu.io/upload_images/12353119-6895b15dc898066e.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

```php
@forelse($notis as $k=>$v)
    <tr>
        <td>
            {{ empty($v->read_at) ? '未读' : '已读' }}
        </td>
        <td>
            {{ $v->data['user_name'] }} 在您发布的文章《{{ $v->data['title'] }}》 中发布了评论: {{ $v->data['content'] }}
        </td>
    </tr>
@empty
    <tr>
        <th colspan="2">
            <p style="text-align:center; padding: 20px">
                还没有信息
            </p>
        </th>
    </tr>
@endforelse
```

#### 标记所有为已读/未读

```html
<a href="{{ url('noti/readall') }}" class="ui small button">
    标记所有为已读
</a>
<a href="{{ url('noti/notreadall') }}" class="ui small button">
    标记所有为未读
</a>
```
**logic**

```php
public function readall()
{
    Auth::user()
        ->unreadNotifications //获取未读消息
        ->markAsRead(); //改为已读
    return back()->with('success','已将未读消息标记为已读');
}
public function notreadall()
{
    Auth::user()
        ->readNotifications //获取已读消息
        ->markAsUnread(); //改为未读
    return back()->with('success','已将已读消息标记为未读');
}
```
> unreadNotifications 就是 从`User.php`的` use Notifiable;`加载`HasDatabaseNotifications`出来的

### 统计出用户发布的评论

1.**在`Providers/EventServiceProvider.php/$listen`创建监听**

![](https://upload-images.jianshu.io/upload_images/12353119-96ed5971d4f837b7.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

2.运行命令

`php artisan event:generate`

![](https://upload-images.jianshu.io/upload_images/12353119-ffc908d1b8193d56.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

3.**触发事件`CommentController.php/store`**

```php
// 触发事件 $user = Auth::user();
event(new ReplyEvent($user));
```
4.**ReplyEvent事件**

```php
use App\User;
public $user_info;
public function __construct(User $user_info)
{
    $this->user_info = $user_info;
}
```
5.**ReplyEventListener事件监听者**

```php
public function handle(ReplyEvent $event)
{
    //
    $user = $event->user_info;
    $user->increment('comment_count',1); //默认加1
}
```

> handle 处理

### 验证

`php artisan make:request UserUpdateRequest`<br> 
1.**依赖注入**
```php
 public function update(UserUpdateRequest $request, $id)
 {
     your logic...
 }
``` 

2.**判断唯一验证**

[验证器] `use Illuminate\Validation\Rule;`
```php
 public function rules()
    {
        //sometimes只是有值才会验证
        $id = $this->route('id');

        return [
//            'name' => 'required|max:15|unique:users',
            'name' => [
                'required',
                'max:15',
                Rule::unique('users')->ignore($id)
            ],
            'desc' => 'required|between:3,255',
            'cover' => 'sometimes|image'
        ];
    }
```
### 上传
1.**中间件**

`php artisan storage:link`

[控制器] `use Illuminate\Support\Facades\Storage;`

```php
if($request->file('cover')){
    $cover = Storage::putFile('/public/book',$request->file('cover'));
    $data['cover'] = Storage::url($cover);
}
```
### 给文章添加tag标签

**具体步骤:**

1. 创建数据库,添加`article_id`和`tag_id`

```php
php artisan make:migration create_article_tag_table
```
2. 在`ArticleController`控制器加入`attach`

> 添加

```php
public function store(AritcleValidateRequest $request)
{
    $data = $request->all();
    $create_data = [
        'title' => $data['title'],
        'desc' => $data['desc'],
        'content' => $data['content'],
        'user_id' =>  Auth::user()->id
    ];
    $file = $request->file('cover');
    if ($file) {
        $cover_path = $file->store('public/article');
        $create_data['cover'] = Storage::url($cover_path);
    }
    //接收tag
    $article = Book::find($data['book_id'])
        ->article()
        ->create($create_data);
    //利用返回值
    $article->tag()->attach($data['tags']);

    return redirect('/article');
}
```
> 修改

```php
public function update(AritcleValidateRequest $request,$id)
{
    $article = Article::findOrFail($id);
    $data = $request->only([
        'title',
        'desc',
        'content'
    ]);
    $file = $request->file('cover');
    if ($file) {
        $cover_path = $file->store('public/article');
        $data['cover'] = Storage::url($cover_path);
    }
    $article->update($data);
    //sync 同步关联关系
    $article->tag()->sync($request->tags);
    return back()->with('success', '成功更新文摘信息');
}
```

3.在模型加入多对多关系`belongsToMany`

- **Article.php**加入了`tag`方法

```php
public function tag()
    {
        return $this->belongsToMany(
            Tag::class,
            'article_tag',
            'article_id',
            'tag_id'
        );
    }
```

- **Tag.php**加入了`article`方法

```php
 public function article()
    {
        return $this->belongsToMany(
            Article::class,
            'article_tag',
            'tag_id',
            'article_id'
        );
    }
```    

4. 在页面模板展示

```html
<select name="tags[]" class="ui selection dropdown" multiple="" id="multi-select">
    @foreach($tags as $tag)
        <option value="{{ $tag->id }}"
          @if(!empty($article_tag) && in_array($tag->id,$article_tag)) selected @endif
        >{{ $tag->tag_name }}</option>
    @endforeach
</select>
```

> 得先在页面展示全部标签

### foreach与forelse的区别
1.

```php
@forelse($data as $v)

循环数据内容.....

@empty

数据为空提示...

@endforelse
```

2.
```php
@foreach($data as $v)

循环数据内容.....

@endforech
```

### 自增/自减
`increment()`
`decrement()`
### 清空表
`truncate()`
### 生成Model文件
1.使用命令
`php artisan make:model User`
加入 --migration【**-m**】 参数生成对应的数据库迁移文件

### 创建一个控制器
`php artisan make:controller BookController`  <br>
`php artisan make:controller --resource PerekamanController`
【-r资源路由 | -m资源数据库】
### 独立创建控制器表
`php artisan make:migration care_book_tag_table`

### 创建一个表 `(数据库迁移)`
**`php artisan migrate`**

### ORM模型关联
1. **一对一关联**
`hasOne `、`belongsTo`

例子：<br>
**book主表**【hasOne】<br> **bookcard附表**【belongsTo】
2. **一对多**
`hasMany`、`belongsTo`

例子：<br>
**bookcard主表**【hasMany】<br> **BookBorrowHistory[借书记录]附表**【belongsTo】
3. **多对多**

`belongsToMany`<br>

**例子**：books:id ->(book_id)book_tag(tag_id)<-tags:id

### 后台

#### 发送Ajax

* Ajax所有请求要添加`csrf token`头<br>
`头部添加：<meta name="csrf-token" content="{{ csrf_token() }}">`<br>
`script添加：    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });`
* 使用`type`规定请求类型
* Lravel会根据请求类型`自动返回`对应格式的响应
### 数据库

#### 使用路由判断数据库是否连接成功

```
Route::get('/',function (){
    $name = DB::connection()->getDatabaseName();
    echo $name;   //打印出数据库名称my_laravel
});
```
#### 停止服务器（down/up）

php artisan down

#### 开启服务器

php artisan up

#### 给数据库添加其他字段

`migration add_cover_desc_to_users --table=users`<br>
```php
 public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            //
            $table->string('cover')->nullable();
            $table->string('desc')->nullable();
        });
    }
```
```php
public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
            $table->string('cover')->nullable();
            $table->string('desc')->nullable();
        });
    }
```
    
`php artisan migrate`

#### 重新给数据表增加了字段，会把这个数据表清空

`php artisan migrate:refresh --seed`
 
### 删除

```php
 //查看已删除的字段 withTrashed【注意：必须要在数据迁移定义软删除  $table->softDeletes();
        /*判断是否已删除
        "return Boolean"
        $book = Book::withTrashed()->find(1);
        dd($book->trashed())查看已删除的数据
        dd($book->restore())恢复
        dd($book->forceDelete())彻底删除*/
   Book::find($id)->delete();
```




















