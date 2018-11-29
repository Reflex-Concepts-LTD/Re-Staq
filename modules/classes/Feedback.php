<?php

class Feedback {

    public function successFeedback($title, $message) {
        $feedback = "<script>
                iziToast.success({
                    title: '{$title}',
                    theme: 'dark',
                    message: '{$message}',
                    position: 'topRight',
                    overlay: 'true',
                    timeout: 10000
                });
            </script>";
        return $feedback;
    }

    public function errorFeedback($title, $message) {
        $feedback = "<script>
                iziToast.error({
                    title: '{$title}',
                    theme: 'dark',
                    message: '{$message}',
                    position: 'topRight',
                    overlay: 'true',
                    timeout: 10000
                });
            </script>";
        return $feedback;
    }

}
