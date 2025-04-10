import React, { useState } from 'react';
import { View, TextInput, Button, Text } from 'react-native';
import { styles } from './css/styles';  

const App = () => {
  const [num1, setNum1] = useState('');
  const [num2, setNum2] = useState('');
  const [num3, setNum3] = useState('');
  const [num4, setNum4] = useState('');
  const [resultado, setResultado] = useState('');
  const [media, setMedia] = useState("");
  const [situacao, setSituacao] = useState("");
  
  const calcularMedia = () => {
    const n1 = parseFloat(num1);
    const n2 = parseFloat(num2);
    const n3 = parseFloat(num3);
    const n4 = parseFloat(num4);

    if (!isNaN(n1) && !isNaN(n2) && !isNaN(n3) && !isNaN(n4)) {
      const contaMedia = (n1 + n2 + n3 + n4) / 4;
      setMedia(contaMedia);
      setResultado("Sua média é : " + contaMedia);

      situacaoAluno(contaMedia); 
    } else {
      setResultado("Número Inválido");
    }
  };

  const situacaoAluno = (media) => {
    if (media) { 
      if (media >= 6) {
        setSituacao("Você foi aprovado");
      } else if (media >= 4 && media < 6) {
        setSituacao("Você está de recuperação");
      } else {
        setSituacao("Você está reprovado");
      }
    }
  };

  return (
    <View style={styles.container}>
      <TextInput 
        style={styles.input}
        placeholder="Digite o primeiro número"
        keyboardType="numeric"
        value={num1}
        onChangeText={setNum1}
      />
      <TextInput
        style={styles.input}
        placeholder="Digite o segundo número"
        keyboardType="numeric"
        value={num2}
        onChangeText={setNum2}
      />
      <TextInput
        style={styles.input}
        placeholder="Digite o terceiro número"
        keyboardType="numeric"
        value={num3}
        onChangeText={setNum3}
      />
      <TextInput
        style={styles.input}
        placeholder="Digite o quarto número"
        keyboardType="numeric"
        value={num4}
        onChangeText={setNum4}
      />
      <TextInput
        style={styles.input}
        placeholder="Resultado"
        value={resultado}
        editable={false} 
      />
      <Button title="Verificar Média" onPress={calcularMedia} />
      <Text>
      {situacao}
      </Text>
  </View>
  );
};

export default App;