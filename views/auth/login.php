<?php $this->layout('layouts/auth') ?>

<div class="w-full h-full flex items-center justify-center p-4">
    <div class="bg-white p-6 rounded w-full max-w-96">
        <h1 class="font-bold text-3xl text-center">Login</h1>
        <p class="mb-4 text-center text-gray-500">Bem-vindo de volta, faça o seu login!</p>
        <form id="login_form" action="<?= $router->route('auth.store') ?>" class="space-y-4">
            <div class="flex flex-col">
                <label for="email">E-mail:</label>
                <input id="email" type="email" name="email" class="input-control" />
            </div>
            <div class="flex flex-col">
                <label for="password">Senha:</label>
                <input id="password" type="password" name="password" class="input-control" />
            </div>
            <button class="btn" type="submit">Entrar</button>
        </form>
    </div>
</div>

<?php $this->push('scripts') ?>
<script>
    $(function() {
        $(document).on('submit', '#login_form', function(e) {
            e.preventDefault()
            const url = $(this).attr("action")
            const data = $(this).serialize()

            $.ajax({
                url: url,
                data: data,
                type: "post",
                dataType: "json",
                beforeSend: function() {
                    $.blockUI()
                },
                success: function (response) {
                    $.unblockUI()

                    if (response.message) {
                        return Swal.fire({
                            icon: "error",
                            html: response.message,
                            confirmButtonText: "Ok, entendi!",
                        })
                    }

                    if (response.redirect) {
                        Swal.fire({
                            icon: "success",
                            html: "Login realizado com sucesso!",
                            showConfirmButton: false,
                            allowOutsideClick: false,
                            allowEscapeKey: false,
                            allowEnterKey: false
                        })
                        setTimeout(() => {
                            window.location.href = response.redirect
                        }, 2000)
                    }
                },
                error: function (err) {
                    $.unblockUI()
                    Swal.fire({
                        icon: "error",
                        html: "Ocorreu algum erro inesperado. Recarregue e tente novamente!",
                        confirmButtonText: "Ok, entendi!"
                    })
                }
            })
        })
    })
</script>
<?php $this->end() ?>