@extends('template.Home_Template')

@section('konten')
    <div class="container-fluid bg-primary py-5 mb-5 text-center text-white">
        <div class="container py-5">
            <h1 class="fw-cover text-uppercase">{{ $test->name }}</h1>
            <p>{{ $test->description }}</p>
        </div>
    </div>

    <div class="container my-5">
        @if ($errors->has('missing_answers'))
            <div class="alert alert-danger">
                {{ $errors->first('missing_answers') }}
            </div>
        @endif
        <div id="myCarousel" class="carousel" data-bs-interval="false">
            <div class="carousel-inner shadow p-5 mb-3 bg-white rounded" data-interval="false">
                <form action="/test-store?test_id={{ $test_uuid }}" method="post">
                    @csrf
                    @foreach ($bai as $indexSoal => $item)
                        <div class="carousel-item {{ $indexSoal == 0 ? 'active' : '' }}">
                            <h5 class="fw-bold">Pertanyaan {{ $indexSoal + 1 }} / {{ $bai->count() }}</h5>
                            <b>{{ $item->question }}</b>
                            <div class="my-3">
                                @foreach (json_decode($item->answer) as $indexJawaban => $answer)
                                    @php
                                        $userAnswers = old('answer');
                                        $userAnswerIndex = $indexSoal; // Indeks jawaban user sesuai dengan urutan soal
                                        $isChecked = isset($userAnswers[$userAnswerIndex]) && $userAnswers[$userAnswerIndex] == $answer->value;
                                    @endphp
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="answer[{{ $indexSoal }}]"
                                            id="answer{{ $indexJawaban }}" value="{{ $answer->value }}"
                                            {{ $isChecked ? 'checked' : '' }}>
                                        <label class="form-check-label" for="answer{{ $indexJawaban }}">
                                            {{ $answer->label }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                            <div class="row mb-3">
                                @if ($indexSoal != 0)
                                    <div class="col">
                                        <button class="btn btn-primary" data-bs-target="#myCarousel" data-bs-slide="prev"><i
                                                class="bi bi-chevron-left"></i></button>
                                    </div>
                                @endif
                                @if ($indexSoal != $bai->count() - 1)
                                    <div class="col text-end">
                                        <button class="btn btn-primary" data-bs-target="#myCarousel" data-bs-slide="next"><i
                                                class="bi bi-chevron-right"></i></button>
                                    </div>
                                @else
                                    <div class="col text-end">
                                        <button class="btn btn-primary" type="submit">Submit</button>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </form>
            </div>
        </div>
    </div>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var carousel = document.querySelector("#myCarousel");
            var radioInputs = carousel.querySelectorAll("input[type='radio']");

            // Menyimpan jawaban yang dipilih
            var selectedAnswers = [];

            // Menangani perubahan pilihan jawaban
            radioInputs.forEach(function(input) {
                input.addEventListener("change", function() {
                    var slideIndex = getSlideIndex(carousel.querySelector(".carousel-item.active"));
                    var selectedAnswer = {
                        slideIndex: slideIndex,
                        answer: input.value
                    };
                    selectedAnswers = updateSelectedAnswer(selectedAnswers, selectedAnswer);
                });
            });

            // Mengatur ulang pilihan jawaban saat slide berubah
            carousel.addEventListener("slid.bs.carousel", function(event) {
                var slideIndex = getSlideIndex(event.relatedTarget);
                var selectedAnswer = getSelectedAnswer(selectedAnswers, slideIndex);
                setRadioInputValue(selectedAnswer);
            });

            // Fungsi untuk mendapatkan indeks slide aktif
            function getSlideIndex(slide) {
                var slides = Array.from(carousel.querySelectorAll(".carousel-item"));
                return slides.indexOf(slide);
            }

            // Fungsi untuk memperbarui jawaban yang dipilih
            function updateSelectedAnswer(answers, newAnswer) {
                var existingAnswer = answers.find(function(answer) {
                    return answer.slideIndex === newAnswer.slideIndex;
                });

                if (existingAnswer) {
                    existingAnswer.answer = newAnswer.answer;
                } else {
                    answers.push(newAnswer);
                }

                return answers;
            }

            // Fungsi untuk mendapatkan jawaban yang dipilih
            function getSelectedAnswer(answers, slideIndex) {
                var selectedAnswer = answers.find(function(answer) {
                    return answer.slideIndex === slideIndex;
                });

                return selectedAnswer || {
                    slideIndex: slideIndex,
                    answer: null
                };
            }

            // Fungsi untuk mengatur nilai radio input
            function setRadioInputValue(selectedAnswer) {
                var radioInput = carousel.querySelector(
                    `input[name='flexRadioDefault[${selectedAnswer.slideIndex}]'][value='${selectedAnswer.answer}']`
                );

                if (radioInput) {
                    radioInput.checked = true;
                }
            }
        });
    </script>
@endsection
