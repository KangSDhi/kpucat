<table id="example1" class="table table-bordered table-striped">
    <thead>
    <tr>
        <th>No</th>
        <th>No Pendaftaran</th>
        <th>Nama</th>
        <th>Wilayah</th>
        <th>Kelurahan</th>
        <th>Nilai</th>
        <th>Keterangan Akhir (LULUS/TIDAK LULUS)</th>
    </tr>
    </thead>
    <tbody id="calonPesertaAssessmentTable">
        @forelse ( $hasilTesPpk as $item)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td> {{$item->no_pendaftaran == null ? '-' : $item->no_pendaftaran }}</td>
            <td>{{$item->nama == null ? '-' : $item->nama }}</td>
            <td>{{$item->wilayah == null ? '-' : $item->wilayah}}</td>
            <td>{{$item->kelurahan == null ? '-' : $item->kelurahan}}</td>
            <td>{{ $item->total_nilai }}</td>
            <td></td>
        </tr>
        @empty
            <td class="text-danger text-center">{{ 'Data Tidak Tersedia' }}</td>
        @endforelse
    </tbody>
</table>
