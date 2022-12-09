<h1> Upload Image</h1>
untuk upload gambar di laravel 
php artisan storage:link

<h1> Memnbuat migration dan model </h1>
php artisan make:model Post -m

-isi table nya
setlah kita membuat field di table, kita akan melakukan mass asignment di model nya
what is mass asignment? mass asigment itu seperti kita mengijin kan field mna yang boleh di isi,(biasanya saya menggunakan
protected $fillable =[
column1
column2
dst.
]
)

<h2> migrate to db </h2>
php artisan migrate

<h1>Make controller </h1>
<h3> Best practices </h3>
buat lah controller dengan kata tunggal atau singular (tidak jamak)
example
PostController✅
PostsController❌

php artisan make:controller PostControllerh1

<h1>make routes </h1>
Route::resource('post', PostController::class);
kita menggunakan resource untuk membuat semua route method (get, put,patch,delete)
to chechk route list you can run
php artisan route:list

<h1> view </h1>
kita looping data yang di kirimkan dari controller ke view
kita menggunakan direktif @forelse(jika data nya ada kita looping data nya, jika tidak ada kita tampilin message)

@forelse ($posts as $post)

    //menampilkan data

@empty

    //menampilkan pesan data belum tersedia

@endforelse

dan untuk pagination nyua kita gfunakan
{{ $posts->links() }}
