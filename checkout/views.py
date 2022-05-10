"""" Checkout views. """
from django.contrib import messages
from django.shortcuts import render, reverse, redirect

from .forms import OrderForm


def checkout(request):
    """
    Checkout view to render template.
    """
    cart = request.session.get('cart', {})
    if not cart:
        messages.error(request, "There's nothing in your cart at the moment.")
        return redirect(reverse('home'))

    order_form = OrderForm()
    template = 'checkout/checkout.html'
    context = {
        'order_form': order_form,
        'stripe_public_key': 'STRIPE_PUBLIC_KEY',
        'client_secret': 'STRIPE_SECRET_KEY',
    }

    return render(request, template, context)
