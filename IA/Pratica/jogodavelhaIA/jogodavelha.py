# Load libraries
import pandas
from pandas.plotting import scatter_matrix
import matplotlib.pyplot as plt
from sklearn import model_selection
from sklearn.metrics import classification_report
from sklearn.metrics import confusion_matrix
from sklearn.metrics import accuracy_score
from sklearn.linear_model import LogisticRegression
from sklearn.tree import DecisionTreeClassifier
from sklearn.neighbors import KNeighborsClassifier
from sklearn.discriminant_analysis import LinearDiscriminantAnalysis
from sklearn.naive_bayes import GaussianNB
from sklearn.svm import SVC



# Load dataset
url = "C:/Users/Odete/Desktop/IA/jogodavelhaIA/jogodavelhaDataBase.csv"
names = ['0','1','2','3','4','5','6','7','8','jogada']
dataset = pandas.read_csv(url, names=names)



# =============================================================================
# # shape
# print(dataset.shape)
# # head
# print(dataset.head(20))
# # descriptions
# print(dataset.describe())
# # class distribution
# print(dataset.groupby('jogada').size())
# # box and whisker plots
# dataset.plot(kind='box', subplots=True, layout=(5,2), sharex=False, sharey=False)
# plt.show()
# # histograms
# dataset.hist()
# plt.show()
# # scatter plot matrix
# scatter_matrix(dataset)
# plt.show()
# =============================================================================



# Split-out validation dataset
array = dataset.values
X = array[:,0:9]
Y = array[:,9]
validation_size = 0.20
seed = 7
X_train, X_validation, Y_train, Y_validation = model_selection.train_test_split(X, Y, test_size=validation_size, random_state=seed)



# =============================================================================
# # Test options and evaluation metric
# seed = 7
# scoring = 'accuracy'
# 
# 
# 
# # Spot Check Algorithms
# models = []
# models.append(('LR', LogisticRegression()))
# models.append(('LDA', LinearDiscriminantAnalysis()))
# models.append(('KNN', KNeighborsClassifier()))
# models.append(('CART', DecisionTreeClassifier()))
# models.append(('NB', GaussianNB()))
# models.append(('SVM', SVC()))
# # evaluate each model in turn
# results = []
# names = []
# for name, model in models:
#     kfold = model_selection.KFold(n_splits=10, random_state=seed)
#     cv_results = model_selection.cross_val_score(model, X_train, Y_train, cv=kfold, scoring=scoring)
#     results.append(cv_results)
#     names.append(name)
#     msg = "%s: %f (%f)" % (name, cv_results.mean(), cv_results.std())
#     print(msg)
# 
# 
# 
# # Compare Algorithms
# fig = plt.figure()
# fig.suptitle('Algorithm Comparison')
# ax = fig.add_subplot(111)
# plt.boxplot(results)
# ax.set_xticklabels(names)
# plt.show()
# =============================================================================



# Make predictions on validation dataset
svm = SVC()
svm.fit(X_train, Y_train)



# =============================================================================
# # Show results for the model
# predictions = nb.predict(X_validation)
# print(accuracy_score(Y_validation, predictions))
# print(confusion_matrix(Y_validation, predictions))
# print(classification_report(Y_validation, predictions))
# =============================================================================



def fimDoJogo(campo):
    for i in range (len(campo)):
        if campo[i] == 0:
            return True
    return False

def printaCampo(campo):
    campoRef = [' ',' ',' ',' ',' ',' ',' ',' ',' ']
    for i in range(len(campo)):
        if campo[i] == 1:
            campoRef[i] = 'x'
        elif campo[i] == 2:
            campoRef[i] = 'o'
            
    print(" {0} | {1} | {2}".format(campoRef[0], campoRef[1], campoRef[2]))
    print(" ---------")
    print(" {0} | {1} | {2}".format(campoRef[3], campoRef[4], campoRef[5]))
    print(" ---------")
    print(" {0} | {1} | {2}".format(campoRef[6], campoRef[7], campoRef[8]))

# Make a prediction on new dataset
campo = [0,0,0,0,0,0,0,0,0]
vezDoPC = not int(input("Deseja começar jogando?"))
while fimDoJogo(campo):
    if vezDoPC:
        jogada = svm.predict([campo])[0]
        if campo[jogada] != 0:
            print("jogada inválida do PC")
            break
        else:
            campo[jogada] = 1
    else:
        printaCampo(campo)
        jogada = int(input("Deseja jogar em qual casa?")) - 1
        if campo[jogada] != 0:
            print("jogada inválida")
            vezDoPC = not vezDoPC
        else:
            campo[jogada] = 2
    vezDoPC = not vezDoPC
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    