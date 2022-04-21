""" Context processor to make cart contents available across site. """
from decimal import Decimal

def cart_contents(request):
    """ Cart contents set up. """

    cart_items = []
    total = 0.00
    project_count = 0

    grand_total = Decimal(total)

    context = {
        'project_count' : project_count,
        'cart_items' : cart_items,
        'total' : total,
        'grand_total' : grand_total,
    }

    return context
