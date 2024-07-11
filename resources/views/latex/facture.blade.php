\documentclass[11pt,a4paper]{article}
\usepackage[utf8]{inputenc}
\usepackage[french]{babel}
\usepackage[T1]{fontenc}
\usepackage{amsmath}
\usepackage{amsfonts}
\usepackage{amssymb}
\usepackage{lmodern}
\usepackage[left=2cm,right=2cm,top=2cm,bottom=2cm]{geometry}
\usepackage{array}  % Pour améliorer les tableaux

\begin{document}

\begin{center}
    \begin{LARGE}
        \textbf{FACTURE}
    \end{LARGE}
\end{center}

\vspace{0.5cm}

\begin{flushleft}
    Date : {{ $commande->date }} \\
    Nom du client : {{ $commande->client }} \\
\end{flushleft}

\vspace{0.5cm}

\begin{tabular}{|p{2cm}|p{10cm}|p{2cm}|p{2cm}|}
    \hline
    Quantité & Désignation & Prix Unitaire & Total \\
    \hline
    @foreach ($ligneCommandes as $ligneCommande)
        {{-- {{$ligneCommande->produits}} --}}
        {{ $ligneCommande->quantite }} & {{ $ligneCommande->produit->libelle }} & {{ number_format($ligneCommande->produit->prix, 2, ',', ' ') }} & {{ number_format($ligneCommande->quantite * $ligneCommande->produit->prix, 2, ',', ' ') }} \\
        \hline
    @endforeach
    \multicolumn{2}{|c|}{\textbf{Somme totale}} & \multicolumn{2}{|c|}{\textbf>{{ number_format($commande->montant, 2, ',', ' ') }} FCFA} \\
    \hline
\end{tabular}

\end{document}
