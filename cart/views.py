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
        project_count = 1
        project_name = request.POST.get('project_name')
        description = request.POST.get('description')
        typex = request.POST.get('type')
        cart = request.session.get('cart', {})
        redirect_url = 'cart/cart.html'

        if type in list(cart.keys()):
            cart[project_count] += project_count
        else:
            cart[project_count] = project_count

        request.session['cart'] = cart

        context = {
            'page': 'cart',
            'project_count':project_count,
            'project_name':project_name,
            'description':description,
            'type':typex,
        }

        return render(request, redirect_url, context)

    else:
        form = ProjectForm()

        template = 'cart/add_project.html'

        context = {
            'page': 'cart',
            'form': form,
        }

        return render(request, template, context)
