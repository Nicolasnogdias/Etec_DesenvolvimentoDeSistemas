import React, { useState } from 'react';
import { View, TextInput, Button, Image } from 'react-native';
import { styles } from './css/styles';

const App = () => {
  const [Idade, setIdade] = useState('');
  const [mensagem, setMensagem] = useState('');
  const [imagem, setImagem] = useState("https://e7.pngegg.com/pngimages/48/293/png-clipart-painted-3d-3d-3d-villain-doubt-cartoon-creative-3d-thumbnail.png");

  const calcularIdade = () => {
    const idade = parseInt(Idade);

    if (isNaN(idade)) {
      setMensagem("Número inválido");
      setImagem("https://e7.pngegg.com/pngimages/48/293/png-clipart-painted-3d-3d-3d-villain-doubt-cartoon-creative-3d-thumbnail.png");
    } else if (idade === 0) {
      setMensagem("Não é possível ter idade 0");
      setImagem("https://e7.pngegg.com/pngimages/48/293/png-clipart-painted-3d-3d-3d-villain-doubt-cartoon-creative-3d-thumbnail.png");
    } else if (idade >= 18) {
      setMensagem("Você é maior de idade");
      setImagem("https://w7.pngwing.com/pngs/540/351/png-transparent-all-the-beautiful-girls-graphy-18-text-photography-trademark-thumbnail.png");
    } else {
      setMensagem("Você é menor de idade");
      setImagem("https://cdn-icons-png.flaticon.com/512/1809/1809217.png");
    }
  };

  return (
    <View style={styles.container}>
    <Image
        source={{ uri: imagem }}
        style={styles.image}
      />
      <TextInput
        style={styles.input}
        placeholder="Vamos verificar a sua idade"
        editable={false}
      />
      
      <TextInput
        style={styles.input}
        placeholder="Digite a sua idade"
        keyboardType="numeric"
        onChangeText={setIdade}
        value={Idade}
      />
      
      <TextInput
        style={styles.input}
        placeholder="Verificação"
        value={mensagem}
        editable={false}
      />

      <Button title="Verificar" onPress={calcularIdade} />
    </View>
  );
};

export default App;