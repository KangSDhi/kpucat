<form class="" action="{{ route('simpan.Jawaban',$soalUjian[$noUrutId]['id']) }}" method="POST">
    @csrf
        <div class="card-body">
            <p class="card-text">{{ $soalUjian[$noUrutId]->soalBenarSalah->soal }}</p>
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
                                value="A" {{ (old('jawaban') ?? $soalUjian[$noUrutId]->jawaban_benar_salah) == 'A' ? 'checked': '' }} >
                                    <label class="text " for="a">
                                    </label>
                                </div>
                        </td>
                        <td>
                            {{ 'a .'.$soalUjian[$noUrutId]->soalBenarSalah->pil_a }}
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <div class="icheck-primary d-inline">
                                <input class="form-check-input" type="radio" name="jawaban" id="b"
                                value="B" {{ (old('jawaban') ?? $soalUjian[$noUrutId]->jawaban_benar_salah) == 'B' ? 'checked': '' }} >
                                    <label class="text " for="b">
                                    </label>
                                </div>
                        </td>
                        <td>
                            {{ 'b .'.$soalUjian[$noUrutId]->soalBenarSalah->pil_b}}
                        </td>
                    </tr>
                </table>
            </div>

            <input type="submit" class="btn btn-info " value="simpan">
        </div>
    </form>
