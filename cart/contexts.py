""" Context processor to make cart contents available across site. """
from .models import UserCart


def cart_contents(request):
    """ Cart contents set up. """
    user = UserCart.user
    cart = request.session.get('cart',[])
    context = {
        'user': user,
        'cart_items': cart,
    }

    return context
