<form class="" action="{{ route('simpan.Jawaban',$soalUjian[$noUrutId]['id']) }}" method="POST">
    @csrf
        <div class="card-body">
            <p class="card-text">{{ $soalUjian[$noUrutId]->soalSebabAkibat->pernyataan_satu }}
                <br>
                <b>{{ $soalUjian[$noUrutId]->soalSebabAkibat->sebab_akibat }}</b>
                <br>
                {{ $soalUjian[$noUrutId]->soalSebabAkibat->pernyataan_dua }}
            </p>
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
                                value="A" {{ (old('jawaban') ?? $soalUjian[$noUrutId]->jawaban_sebab_akibat) == 'A' ? 'checked': '' }} >
                                    <label class="text " for="a">
                                    </label>
                                </div>
                        </td>
                        <td>
                            {{ 'a .'.$soalUjian[$noUrutId]->soalSebabAkibat->pil_a }}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="icheck-primary d-inline">
                                <input class="form-check-input" type="radio" name="jawaban" id="b"
                                value="B" {{ (old('jawaban') ?? $soalUjian[$noUrutId]->jawaban_sebab_akibat) == 'B' ? 'checked': '' }} >
                                    <label class="text " for="b">
                                    </label>
                                </div>
                        </td>
                        <td>
                            {{ 'b .'.$soalUjian[$noUrutId]->soalSebabAkibat->pil_b}}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="icheck-primary d-inline">
                                <input class="form-check-input" type="radio" name="jawaban" id="c"
                                value="C" {{ (old('jawaban') ?? $soalUjian[$noUrutId]->jawaban_sebab_akibat) == 'C' ? 'checked': '' }} >
                                    <label class="text " for="c">
                                    </label>
                                </div>
                        </td>
                        <td>
                            {{ 'c .'.$soalUjian[$noUrutId]->soalSebabAkibat->pil_c }}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="icheck-primary d-inline">
                                <input class="form-check-input" type="radio" name="jawaban" id="d"
                                value="D" {{ (old('jawaban') ?? $soalUjian[$noUrutId]->jawaban_sebab_akibat) == 'D' ? 'checked': '' }} >
                                    <label class="text " for="d">
                                    </label>
                                </div>
                        </td>
                        <td>
                            {{ 'd .'.$soalUjian[$noUrutId]->soalSebabAkibat->pil_d }}
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <div class="icheck-primary d-inline">
                                <input class="form-check-input" type="radio" name="jawaban" id="e"
                                value="E" {{ (old('jawaban') ?? $soalUjian[$noUrutId]->jawaban_sebab_akibat) == 'E' ? 'checked': '' }} >
                                    <label class="text " for="e">
                                    </label>
                                </div>
                        </td>
                        <td>
                            {{ 'e .'.$soalUjian[$noUrutId]->soalSebabAkibat->pil_e }}
                        </td>
                    </tr>
                </table>
            </div>

            <input type="submit" class="btn btn-info " value="simpan">
        </div>
    </form>
