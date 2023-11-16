<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\NewController;
use App\Models\User;
use App\Models\Post;
use App\Models\Role;
use App\Models\Country;
use App\Models\Photo;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     //display page from resources/views folder
//     //return view('welcome'); //filename welcome.blade.php

//     //text display
//     return "HAIIYAAA";
// });

// Route::get('/about', function () {

//     return "This is about page";

// });

// Route::get('/contact', function () {

//     return "This is contact page";

// });

//with parameters
// Route::get('uncleroger/{id}/{name}', function ($id, $name){
//     return "FUIYOOOOOHHH!!!!". $id . " " . $name;
// });

// Route::get('admin/posts/example', array('as'=> 'admin.home' ,function(){
//     $url = route('admin.home');

//     return "this url is ". $url;
// }));


// Route::get('/post',  [NewController::class, 'index']);
// Route::get('/post/{id}',  [NewController::class, 'show']);
// Route::get('/post', [NewController::class, 'contact']);
// Route::get('/post/{id}/{name}/{password}', [NewController::class, 'show_post']);
//Route::resource('posts', PostController::class);

//RAW SQL QUERIES//
Route::get('/insert', function(){
    DB::insert('insert into posts(title, content, is_admin) values(?,?,?)', ['2 PHP with Laravel',
        'Laravel is the best thing that has happened to PHP','0']);
});

// Route::get('/read', function(){

//     $result = DB::select('select * from posts where id = ?', [1]);

//     return var_dump($result);

//     return $result;

//     foreach($result as $post){
//         return $post->content;
//     }
// });

// Route::get('/update', function(){
//     $update = DB::update('update posts set title="Update title" where id = ?', [1]);
//     return $update;
// });

// Route::get('/delete', function(){
//     $delete = DB::delete('delete from posts where id = ?', [2]);
//     return $delete;
// });

//ELOQUENT
//SELECT FROM 
// Route::get('/find', function(){
//     $posts = Post::all();

//     foreach($posts as $post) {
//         echo $post-> title . "<br>";
//     }
// });

//SELECT FROM WHERE
// Route::get('/find', function(){
//     $posts = Post::find(3);

//     return $posts->title;
// });


// Route::get('/findwhere', function(){
//     $post = Post::where('id', 5)->orderBy('id', 'desc')->take(1)->get();

//     return $post;
// });

// Route::get('findmore', function(){
//     // $posts = Post::findOrFail(2);

//     // return $posts;

//     $posts = Post::where('id', '<', 50)-> firstOrFail();

//     return $posts;
    
// });

Route::get('/basicinsert', function(){
    $post = new Post;

    $post->title = 'Uncle Roger Review';
    // $post->user_id = 1;
    $post->content = 'ALWAYS BREAK EGG WITH ONE HAND';
    $post->is_admin = 0;

    $post->save();
});

Route::get('/create_user', function(){
    $user = new User;

    $user->id = 1;
    $user->name = 'Ninong Ry';
    $user->email = 'haiya@gmail.com';
    $user->password = 'FUIYOH@123';

    $user->save();
});

// Route::get('/basicinsert', function(){
//     $post = Post::find(3);

//     $post->title = 'New Eloquent title insert';
//     $post->content = 'WHY NOT PUT MSG IN THERE? HAIYAAA!!';
//     $post->is_admin = 0;

//     $post->save();
// });

// Route::get('/create', function(){
//     Post::create(['title'=>'the create method', 'content'=>'Wow I\'am learning a lot with Uncle Roger', 'is_admin'=>0]);
// });

// Route::get('/update', function(){
//     Post::where('id', 4)->where('is_admin',0)->update(['title'=>'New Title', 'content'=>'You allergic to peanuts? why so weak?']);
// });

// Route::get('/delete', function(){
//     $post = Post::find(3);

//     $post->delete();
// });

// Route::get('/delete2', function(){
//     Post::destroy([5,6]);

    // Post::where('is_admin', 0)->delete();
// });

Route::get('/softdelete', function(){
    Post::find(9)->delete();
});

// Route::get('/readsoftdelete', function(){
    // $post = Post::find(7);

    // return $post;

    // $post = Post::withTrashed()->where('id',7)->get();

    // return $post;

    // $post = Post::onlyTrashed()->where('id', 7)->get();
    // return $post;
// });    

// Route::get('/restore',function(){
//     Post::withTrashed()->where('is_admin',0)->restore();
// });

Route::get('forcedelete', function(){
    Post::onlyTrashed()->where('is_admin',0)->forceDelete();
});

//One to One Relationship
Route::get('/user/{id}/post', function($id){
    return User::find($id)->post;

});

Route::get('post/{id}/user', function($id){

    return Post::find($id)->user->name;
    
});

//One to Many Relationship
Route::get('/posts', function(){

    $user = User::find(1);

    foreach($user->posts as $post){
        echo $post->title . "<br>";
    }
});

Route::get('/user/{id}/role', function($id){
    $user = User::find($id)->roles()->orderBy('id','desc')->get();
    
    return $user;
    // foreach($user->roles as $role){
    //     return $role->name;
    // }
});
//accessing the intermediate table / pivot
Route::get('user/pivot', function(){
    $user = User::find(1);

    foreach($user->roles as $role){
        echo $role->pivot->created_at;
    }
});

Route::get('/user/{id}/country', function($id){
    $country = Country::find($id);

    foreach($country->posts as $post){
        return $post->title;
    }
});

//Polymorphic Relations
Route::get('/user/photos', function() {
    $user = User::find(1);

    foreach($user->photos as $photo){
        echo $photo->path . "<br>";
    }
});