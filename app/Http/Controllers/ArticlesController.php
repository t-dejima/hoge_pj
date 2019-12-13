<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\StreamedResponse;
use App\Article;
use App\Profile;
use Log;
use App\Http\Requests\CreateUserRequest;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use alhimik1986\PhpExcelTemplator\PhpExcelTemplator;
// Mailファサードをインポート.
use Illuminate\Support\Facades\Mail;



class ArticlesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     
      public function __construct()
    {
        $this->middleware('auth');
    }
     
     
    public function index(Request $request)
    {
      
       //キーワードを取得
        $keyword = $request->input('keyword');

        //もしキーワードが入力されている場合
        if(!empty($keyword))
        {   
            //検索
            $articles = DB::table('articles')
                    ->where('title', 'like', '%'.$keyword.'%')
                    ->paginate(10);

        }else{//キーワードが入力されていない場合
            //$articles = Article::all()
            $articles = DB::table('articles')->paginate(10);
        }
      
    
      //  $articles = Article::all();
      // return $articles;
      // 以下のように修正
      return view('articles.index', ['articles' => $articles]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('articles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $request->validate([
        'title' => 'required',
        'body' => 'required',
    ]);
      
      
        // モデルからインスタンスを生成
  $article = new Article;
  // $requestにformからのデータが格納されているので、以下のようにそれぞれ代入する
  $article->title = $request->title;
  $article->body = $request->body;

  // 保存
  $article->save();
  // 保存後 一覧ページへリダイレクト
  return redirect('/articles');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
         // 引数で受け取った$idを元にfindでレコードを取得
  $article = Article::find($id);
  //dd($article);
  // viewにデータを渡す
  return view('articles.show', ['article' => $article]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $article = Article::find($id);
  return view('articles.edit', ['article' => $article]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // idを元にレコードを検索して$articleに代入
  $article = Article::find($id);
  // editで編集されたデータを$articleにそれぞれ代入する
  $article->title = $request->title;
  $article->body = $request->body;
  // 保存
  $article->save();
  // 詳細ページへリダイレクト
  return redirect("/articles/".$id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
           Article::find($id)->delete(); // softDelete
        // idを元にレコードを検索
  //$article = Article::find($id);
  // 削除
  //$article->delete();
  // 一覧にリダイレクト
  return redirect('/articles');
    }
    
     public function delete($id)
    {
        Article::find($id)->delete(); // softDelete
 
        return redirect()->to('articles');
    }

    public function export_csv(Request $request)
    {
        return  new StreamedResponse(
            function () {
                $csv = Article::all(['id', 'title', 'body'])->toArray();

                $stream = fopen('php://output', 'w');
                foreach ($csv as $line) {
                    fputcsv($stream, $line);
                }
                fclose($stream);
            },
            200,
            [
                'Content-Type' => 'text/csv',
                'Content-Disposition' => 'attachment; filename="1users.csv"',
            ]
        );
    }
    
    public function import_csv(Request $request)
{
  // setlocaleを設定
    setlocale(LC_ALL, 'ja_JP.UTF-8');

    // アップロードしたファイルを取得
    // 'csv_file' はCSVファイルインポート画面の inputタグのname属性
    $uploaded_file = $request->file('csv_file');

    // アップロードしたファイルの絶対パスを取得
    $file_path = $request->file('csv_file')->path($uploaded_file);

    $file = new \SplFileObject($file_path);
    $file->setFlags(\SplFileObject::READ_CSV);

    $row_count = 1;
    foreach ($file as $row)
    {
        // 1行目のヘッダーは取り込まない
        if ($row_count > 1)
        {
            $id = mb_convert_encoding($row[0], 'UTF-8', 'SJIS');
            $name = mb_convert_encoding($row[1], 'UTF-8', 'SJIS');
            $age = mb_convert_encoding($row[2], 'UTF-8', 'SJIS');

            var_dump($id);
            var_dump($name);
            var_dump($age);

            // ここで値をデータベースに保存したりする

        }
        $row_count++;
    }
}

public function excel_temp(Request $request)
{
    $import = storage_path('app/base.xlsx');
    $export = storage_path('app/result.xlsx');


        Log::debug($import);
        Log::info($export);
       

$today = Carbon::now();
$divisions = Article::all() -> pluck('title') -> toArray();


$food = array(); //食べ物を保存する配列変数
$fruit = array("Apple","Orange"); //フルーツのデータを格納
$meat = array("Pork","Beaf"); //お肉のデータを格納
 
array_push($food,$fruit) ; //foodの１段目にフルーツの配列を格納
array_push($food,$meat) ; //foodの１段目にお肉の配列を格納

  Log::info($divisions);
   Log::info($food);
// 書き込むデータ
$data = [
    // 文字列型で
    '{current_time}' => $today->toDateTimeString(),
    // [divisions]には1次元配列で
    //'[divisions]' => ['東京', '大阪'],
    '[divisions]' => $divisions,
    // [[core_times]]には 2次元配列で
    //'[[core_times]]' => [['9時', '10時', '11時', '12時', '13時', '14時', '15時', '16時', '17時', '18時']],
    '[[core_times]]' => $food,
    
    // [[sales]]には二次元配列で
    //'[[sales]]' =>  [
    //  [58000, 110000, 140000, 230000, 180000, 60000, 85000, 109000, 142000, 98000],
     // [41000, 720000, 91000, 190000, 113000, 80000, 62000, 87000, 112000, 84000],
    //]
    '[[sales]]' => $food
];

// excelファイルを発行
//PhpExcelTemplator::saveToFile($import, $export, $data);
// 直接ダウンロードさせる場合
//header('Content-Type: application/octet-stream');
//$filename = '適当につけてください'
PhpExcelTemplator::outputToFile($import, $export, $data);
    Log::info($data);
}

// メールを送信するメソッド.

public function send_mail()
{
    
    $data = [];
    
   // Mail::sendで送信できる.
        // 第1引数に、テンプレートファイルのパスを指定し、
        // 第2引数に、テンプレートファイルで使うデータを指定する
    
Mail::send('emails.user_register', $data, 
        function($message) {
            // 第3引数にはコールバック関数を指定し、
            // その中で、送信先やタイトルの指定を行う.
            $message
                ->to('nekorento@gmail.com')
                ->bcc('nekorento@gmail.com')
                ->subject("ユーザー登録ありがとうございます");
        });
}
}