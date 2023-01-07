<form class="" action="{{ route('simpan.Jawaban',$soalUjian[$noUrutId]['id']) }}" method="POST">
    @csrf
        <div class="card-body">
            <p class="card-text">{!! $soalUjian[$noUrutId]->soalPilihanGanda->soal !!}</p>
            {{-- Form Group untuk Radio Button --}}
            <div class="form-group clearfix">
                <table border="0">
                    <tr>
                        <th width="20px"></th>
                        <th width="1000px"></th>
                    </tr>
                    <tr>
                        <td>
                            <div class="icheck-primary d-inline">
                                <input class="form-check-input" type="radio" name="jawaban" id="a"
                                value="A" {{ (old('jawaban') ?? $soalUjian[$noUrutId]->jawaban_pilihan_ganda) == 'A' ? 'checked': '' }} >
                                    <label class="text " for="a">A
                                    </label>
                                </div>
                        </td>
                        <td>
                            {!! $soalUjian[$noUrutId]->soalPilihanGanda->pil_a !!}
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <div class="icheck-primary d-inline">
                                <input class="form-check-input" type="radio" name="jawaban" id="b"
                                value="B" {{ (old('jawaban') ?? $soalUjian[$noUrutId]->jawaban_pilihan_ganda) == 'B' ? 'checked': '' }} >
                                    <label class="text " for="b">B
                                    </label>
                                </div>
                        </td>
                        <td>
                            {!! $soalUjian[$noUrutId]->soalPilihanGanda->pil_b !!}
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <div class="icheck-primary d-inline">
                                <input class="form-check-input" type="radio" name="jawaban" id="c"
                                value="C" {{ (old('jawaban') ?? $soalUjian[$noUrutId]->jawaban_pilihan_ganda) == 'C' ? 'checked': '' }} >
                                    <label class="text " for="c">C
                                    </label>
                                </div>
                        </td>
                        <td>
                            {!!  $soalUjian[$noUrutId]->soalPilihanGanda->pil_c!!}
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <div class="icheck-primary d-inline">
                                <input class="form-check-input" type="radio" name="jawaban" id="d"
                                value="D" {{ (old('jawaban') ?? $soalUjian[$noUrutId]->jawaban_pilihan_ganda) == 'D' ? 'checked': '' }} >
                                    <label class="text " for="d">D
                                    </label>
                                </div>
                        </td>
                        <td>
                            {!! $soalUjian[$noUrutId]->soalPilihanGanda->pil_d !!}
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <div class="icheck-primary d-inline">
                                <input class="form-check-input" type="radio" name="jawaban" id="e"
                                value="E" {{ (old('jawaban') ?? $soalUjian[$noUrutId]->jawaban_pilihan_ganda) == 'E' ? 'checked': '' }} >
                                    <label class="text " for="e">E
                                    </label>
                                </div>
                        </td>
                        <td>
                            {!! $soalUjian[$noUrutId]->soalPilihanGanda->pil_e !!}
                        </td>
                    </tr>
                </table>
            </div>

            <input type="submit" class="btn btn-info " value="simpan">
        </div>
    </form>
