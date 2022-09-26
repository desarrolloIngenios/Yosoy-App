<style>
#form {
  width: 250px;
  margin: 0 auto;
  height: 100px;
}

form p {
  text-align: center;
}

form p label {
  font-size: 40px;
}

input[type="radio"] {
  display: none;
}

label {
  color: grey;
}
@foreach($question_star as $question)

    .clasificacion_{{$question->id}} {
    direction: rtl;
    unicode-bidi: bidi-override;
    }

    .clasificacion_{{$question->id}} label:hover,
    .clasificacion_{{$question->id}} label:hover ~ label {
    color: orange;
    }
@endforeach
input[type="radio"]:checked ~ label {
  color: orange;
}
</style>
