""" Cart app views. """
from django.shortcuts import render
from django.contrib.auth.decorators import login_required
from .forms import ProjectForm

# Create your views here.
def view_cart(request):
    """ A view that renders the contents of the cart. """

    return render(request, 'cart/cart.html')

@login_required
def add_project(request):
    """ Add proposed project info to cart. """
    if request.method == 'POST':
        cart = request.session.get('cart', {})
        project_count = 1
        project_name = request.POST.get('project_name')
        description = request.POST.get('description')
        project_type = request.POST.get('type')
        redirect_url = 'cart/cart.html'

        if project_count in list(cart.keys()):
            cart['project_count'] += project_count
        else:
            cart['project_count'] = project_count

        cart['project_name'] = project_name
        cart['description'] = description
        cart['project_type'] = project_type

        request.session['cart'] = cart

        print(request.session['cart'])
        return render(request, redirect_url)

    else:
        form = ProjectForm()

        template = 'cart/add_project.html'

        context = {
            'page': 'cart',
            'form': form,
        }

        return render(request, template, context)
