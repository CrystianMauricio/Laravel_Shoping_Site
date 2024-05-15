<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\ProdukDetail;
use App\Models\UserVisitHistory;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Route;
class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $barang = Produk::all();
        // return response()->json($barang);
        return view('administrator/barang/barang',compact('barang'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $imageName = time().'.'.$request->foto->extension();
        // $foto = $request->foto->move(public_path('image'), $imageName);

        $produk = new Produk;
        $produk->users_id = $request->users_id;
        $produk->nama_produk = $request->nama_produk;
        $produk->qty = $request->qty;
        $produk->jenis = $request->jenis;
        $produk->bv = $request->bv;
        $diagram = $request->file('file');
        // $filename = "backup-" . Carbon::now()->format('Y-m-d_H-i-s') . ".sql";
        if($diagram) {
            error_log($diagram);
            $url = $diagram->store('upload/files');
            $produk->filepath = Storage::url($url);
            $produk->filepath = $url;
        }

        $produk->save();

        $detail = new ProdukDetail;
        $detail->harga = $request->harga;
        $produk->detail()->save($detail);

        // Produk::create(
        // [
        //     'users_id' => $request->users_id,
        //     'nama_produk' => $request->nama_produk,
        //     'qty' => $request->qty,
        //     'jenis' => $request->jenis,
        //     'bv' => $request->bv,
        //     'harga' => $request->harga,
        //     'foto' => $request->foto->move(public_path('image'), $imageName)
        // ]);
        return redirect()->route('barang.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $detail = ProdukDetail::find($id); 
        $produk = Produk::find($id);
        return response()->json([
            'detail' => $detail,
            'produk' => $produk
        ]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $produk = Produk::query()->where('id', $request->id)->update([
            'users_id' => $request->users_id,
            'nama_produk' => $request->nama_produk,
            'qty' => $request->qty,
            'jenis' => $request->jenis,
            'bv' => $request->bv,
        ]);

        $detail = ProdukDetail::query()->where('id', $request->id)->update([
            'produk_id' => $request->produk_id,
            'harga' => $request->harga,
        ]);

        // $update->update($request->all());
        return redirect()->route('barang.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $detail = ProdukDetail::find($id); 
        $produk = Produk::find($id);
        $detail->delete();
        $produk->delete();
        return redirect()->route('barang.index');
    }
    public function uservistlist($pos)
    {
        // UserVisitHistory
        // $pos = $request->pos;
        if($pos<0)
            $pos=0;
        // error_log("cccccccccccccccccccccccc");
        // error_log($pos);
        $history = UserVisitHistory::orderBy('visited_at', 'desc')->skip($pos*50)->take(51)->get();
        error_log($history );
    	return view('administrator/visithistory/visithistory', ['history' => $history, 'pos' => $pos]);
    }
    public function viewitem($id)
    {
        // error_log(Auth::user());
        $produk = Produk::find($id);
        
        // error_log(Auth::user()->role);
        // if(Auth::user()->role=='user'){
            
            $uservisithistory = new UserVisitHistory;
            $uservisithistory->users_id = Auth::user()->id;
            $uservisithistory->username = Auth::user()->name;
            $uservisithistory->userlocation = Auth::user()->location;
            $uservisithistory->usercompany = Auth::user()->company;
            $uservisithistory->useremail = Auth::user()->email;
            $uservisithistory->nama_produk = $produk->nama_produk;
            $uservisithistory->filepath = $produk->filepath;
            error_log("deeeeeeee");

            $uservisithistory->save();
        // }

        $filePathsss = storage_path('app/'.$produk->filepath);
       
            return response()->file($filePathsss);
        
    }
}
