# """" Checkout views. """
# from django.contrib import messages
# from django.shortcuts import render, reverse, redirect

# from .forms import OrderForm


# def checkout(request):
#     """
#     Checkout view to render template.
#     """
#     cart = request.session.get('cart', {})
#     if not cart:
#         messages.error(request, "There's nothing in your cart at the moment.")
#         return redirect(reverse('home'))

#     order_form = OrderForm()
#     template = 'checkout/checkout.html'
#     context = {
#         'order_form': order_form,
#         'stripe_public_key': 'pk_test_51KfTaaCzHgmfLydR4JJgW3DHFNkWSfaJx9mcP8pQiOK9KXtY6dWNY3qOi3TRZFzctoOeX6gSnsXVNce6xtrSe3Vx00A0CYz7D1',
#         'client_secret': 'test client secret',
#     }

#     return render(request, template, context)
