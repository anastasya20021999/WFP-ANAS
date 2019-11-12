
<h1>Tambah transaksi baru</h1>

<form method="post" action="{{url('transaksis')}}" enctype="multipart/form-data">
  <table>
    <input type="hidden" name="_token" value="{{csrf_token()}}"/>
    <input type="hidden" name="user" value="{{Auth::user()->id}}"/>
    <tr>
      <td>Saldo</td>
      <td><select name="jenis_saldo">
      @if(count($hasilSaldo)>0)
	      	@foreach($hasilSaldo as $saldo)
				@if($saldo->user_id==Auth::user()->id)
				 <option value="{{$saldo->id}}">{{$saldo->nama}}</option>
				@endif
			@endforeach
		else
			Saldomu Belum ada tambah dlu saldomu
		@endif
      </select></td>
    </tr>
     <tr>
      <td>Master</td>
      <td><select name="jenis_master">
      	@if(count($hasilMaster)>0)
	      	@foreach($hasilMaster as $master)
				@if($master->user_id==Auth::user()->id)
				 <option value="{{$master->id}}">{{$master->nama}}</option>
				@endif
			@endforeach
		else
			Mastermu Belum ada tambah dlu mastermu
		@endif
      </select></td>
    </tr>
    <tr>
      <td>Keterangan</td>
      <td><textarea name="keterangan_transaksi"/></textarea></td>
     <!--  <td><input type="text" name="jenis_master"></td> -->
    </tr>
    <tr>
    	<td>
    		Nominal:
			<input type="number" name="jumlah" min="1" max="1000000000">
    	</td>
    </tr>
    <tr>
    	<td>
    		Tambah gambar:
    		<input type="file" name="image" id="file">
				@if ($errors->has('image'))
	            	<span class="help-block">
	                	<strong>{{ $errors->first('image') }}</strong>
	            	</span>
	        	@endif
    	</td>
    </tr>
    
  </table>
  <input type="submit" name="Simpan" value="Simpan"/>
</form>
