<div class="container">
    <div class="col-4 offset-4">

        <h1>Forgot Password</h1>
        
        <?php if (session()->has('success')): ?>
            <div class="alert alert-success">
                <?= session('success') ?>
            </div>
        <?php endif; ?>
        <?php if (session()->has('error')): ?>
            <div class="alert alert-danger">
                <?= session('error') ?>
            </div>
        <?php endif; ?>

        <?= \Config\Services::validation()->listErrors() ?>

        <?= form_open(base_url().'forgot_password/submit') ?>
            <?= csrf_field() ?>
            <div class="form-group">
                <label for="email">Email address</label>
                <input type="email" class="form-control" name="receiver" required>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>

	</div>
</div>