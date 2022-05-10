""" Context processor to make cart contents available across site. """
from operator import itemgetter
from .models import UserCart

cart_items = []
total = 0

def cart_contents(request):
    """ Cart contents set up. """
    
    cart = request.session.get('cart',[])

    res_list = list(map(itemgetter('price'), cart))
    res_nl= [float(x) for x in res_list]
    total = sum(res_nl)

    grand_total = total

    context = {
        
        'cart_items': cart,
        'grand_total': grand_total
    }

    return context
