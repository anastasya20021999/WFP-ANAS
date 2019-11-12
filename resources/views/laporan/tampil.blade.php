@if (session('pesan'))
                <div style="background-color: green; color: white;
                    font-weight: bold;">
                    {{session('pesan')}}
                </div>
                @endif
                @if(count($hasilTransaksi)>0)
                <table border="1">
                    <tr>
                        <th>No</th>
                        <th>Jumlah</th>
                        <th>Keterangan</th>
                        <th>Saldo</th>
                        <th>Jenis Trasaksi</th>
                        <th>Nama Transaksi</th>
                        <th>Gambar</th>
                        <th>Tanggal Create</th>
                    </tr>
                    
                        @foreach ($hasilTransaksi as $no=>$transaksi)
                        <tr>
                            <td>{{ $no+1 }}</td>
                            <td>{{ $transaksi->jumlah }}</td>
                            <td>{{ $transaksi->keterangan }}</td>
                            @foreach($hasilSaldo as $saldo)
                                @if($transaksi->saldo_id==$saldo->id)
                                <td>{{$saldo->nama}}</td>
                                <!-- sudah dapet objek barang tinggal ambil yg mau ditampilin-->
                                @endif
                            @endforeach
                            @foreach($hasilMaster as $master)
                                @if($transaksi->master_id==$master->id)
                                <td>{{$master->jenis}}</td>
                                <td>{{$master->nama}}</td>
                                <!-- sudah dapet objek barang tinggal ambil yg mau ditampilin-->
                                @endif
                            @endforeach
                                    <td><img width="150px" src="{{url('/data_file/'.$transaksi->nama_gambar)}}"></td>
                            <td>{{ strftime('%Y-%m-%d',
                                     strtotime($transaksi->created_at)) }}</td>
                        </tr>
                        @endforeach
                    @else
                        </table>
                        Transaksimu belum ada tambah transaksi yuk!
                    @endif  
                </table>
                </h3>