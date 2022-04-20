""" Context processor to make cart contents available across site. """

def cart_contents(request):
    """ Cart contents set up. """

    cart_items = []
    total = 0.00
    project_count = 0.00

    context = {
        'cart_items' : cart_items,
        'total' : total,
        'project_count' : project_count,
    }

    return context
